args = commandArgs(trailingOnly=TRUE)

.libPaths("/home/tw/R/x86_64-pc-linux-gnu-library/3.4")
# Load Required Pacakges
library(readtext)
library(tm)
library(SnowballC)
library(lsa)


# Load Documents 
documents <- readtext("documents/*.txt")
query <- args[1]


# Corpus Creation
input <-  c(documents$text,query)
docs <- Corpus(VectorSource(input))


# Text Cleaning
docs <- tm_map(docs, removeNumbers)
docs <- tm_map(docs, removePunctuation)
docs <- tm_map(docs, stemDocument)
docs <- tm_map(docs, stripWhitespace)
docs <- tm_map(docs, content_transformer(tolower))
docs <- tm_map(docs, removeWords,stopwords("en"))
docs <- tm_map(docs, stripWhitespace)

# Generating Term Document Matrix with TiIdF weight
DTM <- TermDocumentMatrix(docs,control = list(weighting = weightTfIdf,minWordLength = 3))


# Converting DTM into Matrix
m <- as.matrix(DTM)

# Setting Column Names to the Matrix m
colnames(m) <- c(documents$doc_id,"query")

# Counting Number of Documents
N <- nrow(documents)

# Data Separation/Split
query.vector <- m[,N+1]
doc.vector <- m[,1:N]

# Cosine Similarity
result <- cosine(query.vector,doc.vector)


result=as.data.frame(cbind(documents$doc_id,result))
rownames(result)<-NULL
colnames(result)<-c("Document",'Score')
result=result[order(result$Score,decreasing = TRUE),]

# Top Simmilar Documents
paste(result$Document[1:5],",",result$Score[1:5])
