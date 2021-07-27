import math
import numpy as np
import pandas as pd
import mysql.connector
from sklearn.feature_extraction.text import TfidfVectorizer

# Connect to database
db = mysql.connector.connect(host='localhost',
                             database='bismillah_ta',
                             user='root',
                             password='',
                             charset='utf8'
                            )

getDb = pd.read_sql_query("select tweet from prepro1", db)
df = pd.DataFrame(getDb)
print(df)
corpus = df["tweet"].values.tolist()
print("Dataset to list :\n", corpus)
for row in corpus:
    print(row)

# vectorize = TfidfVectorizer()
# x = vectorize.fit_transform(df['tweet'])
# print(x.shape)
# vocab = vectorize.get_feature_names()
# print("Kumpulan Kata :\n", vocab)
# print("\n")

print("input your keyword :")
inp = input()
vocab = inp.split(" ")
    
# TF
def compute_tf(corpus):
    for doc in corpus:
        doc1_lst = doc.split(" ")
        wordDict_1= dict.fromkeys(set(doc1_lst), 0)

        for token in doc1_lst:
            wordDict_1[token] +=  1
        df = pd.DataFrame([wordDict_1])
        idx = 0
        new_col = ["Term Frequency"]    
        df.insert(loc=idx, column='Dataset', value=new_col)
        print(df)
compute_tf(corpus)

#Normalized Term Frequency
def termFrequency(term, document):
    normalizeDocument = document
    return normalizeDocument.count(term.lower()) / float(len(normalizeDocument))

def compute_normalizedtf(corpus):
    tf_doc = []
    for txt in corpus["tweet"]:
        sentence = txt.split()
        norm_tf= dict.fromkeys(set(sentence), 0)
        for word in sentence:
            norm_tf[word] = termFrequency(word, txt)
        tf_doc.append(norm_tf)
        df = pd.DataFrame([norm_tf])
        idx = 0
        new_col = ["Normalized TF"]    
        df.insert(loc=idx, column='Dataset', value=new_col)
        print(df)
    return tf_doc

tf_doc = compute_normalizedtf(df)

# Inverse Document Frequency (IDF)
def inverseDocumentFrequency(term, allDocuments):
    numDocumentsWithThisTerm = 0
    for doc in range (0, len(allDocuments)):
        if term.lower() in allDocuments[doc].lower().split():
            numDocumentsWithThisTerm = numDocumentsWithThisTerm + 1
 
    if numDocumentsWithThisTerm > 0:
        return 1.0 + math.log(float(len(allDocuments)) / numDocumentsWithThisTerm)
    else:
        return 1.0

def compute_idf(corpus):
    idf_dict = {}
    for doc in corpus:
        sentence = doc.split()
        for word in sentence:
            idf_dict[word] = inverseDocumentFrequency(word, corpus)
    return idf_dict
idf_dict = compute_idf(corpus)
idf_in = list(idf_dict.items())
to_array = np.array(idf_in)
df_idf_inv = pd.DataFrame(to_array)
print("\n\nInverse Document Frequency (IDF)\n", df_idf_inv)

# tf-idf score across all docs for the query string("life learning")
def compute_tfidf_with_alldocs(corpus , vocab):
    tf_idf = []
    index = 0
    query_tokens = [i.split('\t', 1)[0] for i in vocab]
    df = pd.DataFrame(columns=['doc'] + query_tokens)
    for doc in documents:
        df['doc'] = np.arange(0 , len(corpus))
        doc_num = tf_doc[index]
        sentence = doc.split()
        for word in sentence:
            for text in query_tokens:
                if(text == word):
                    idx = sentence.index(word)
                    tf_idf_score = doc_num[word] * idf_dict[word]
                    tf_idf.append(tf_idf_score)
                    df.iloc[index, df.columns.get_loc(word)] = tf_idf_score
        index += 1
    df.fillna(0 , axis=1, inplace=True)
    return tf_idf , df
            
documents = corpus
tf_idf , df = compute_tfidf_with_alldocs(corpus , vocab)
print("\n",df)

#Normalized TF for the query string("life learning")
def compute_query_tf(vocab):
    query_norm_tf = {}
    tokens = vocab
    for word in tokens:
        query_norm_tf[word] = termFrequency(word , vocab)
    return query_norm_tf
query_norm_tf = compute_query_tf(vocab)
data = list(query_norm_tf.items())
q_tf = np.array(data)
df_qtf = pd.DataFrame(q_tf)
print("\nQuery TF :\n", df_qtf)

#idf score for the query string
def compute_query_idf(vocab):
    idf_dict_qry = {}
    sentence = vocab
    documents = corpus
    for word in sentence:
        idf_dict_qry[word] = inverseDocumentFrequency(word ,documents)
    return idf_dict_qry
idf_dict_qry = compute_query_idf(vocab)
print("\nQuery IDF :")
data = list(idf_dict_qry.items())
an_array = np.array(data)
df_idf = pd.DataFrame(an_array)
print(df_idf)

#tf-idf score for the query string
def compute_query_tfidf(vocab):
    tfidf_dict_qry = {}
    sentence = vocab
    for word in sentence:
        tfidf_dict_qry[word] = query_norm_tf[word] * idf_dict_qry[word]
    return tfidf_dict_qry
tfidf_dict_qry = compute_query_tfidf(vocab)
tfidf_vocab = list(tfidf_dict_qry.items())
tfidf_ar = np.array(data)
df_tfidfv = pd.DataFrame(tfidf_ar)
print("TF-IDF vocab :\n\n", df_tfidfv)

# COSINE SIMILARITY
#Cosine Similarity(Query,Document1) = Dot product(Query, Document1) / ||Query|| * ||Document1||

"""
Example : Dot roduct(Query, Document1) 

     Query
     =tfidf(learning w.r.t query) * tfidf(learning w.r.t Document1)/
     sqrt(tfidf(learning w.r.t query)) * 
     sqrt(tfidf(learning w.r.t doc1))

"""
def cosine_similarity(tfidf_dict_qry, df , vocab , doc_num):
    dot_product = 0
    qry_mod = 0
    doc_mod = 0
    tokens = vocab
   
    for keyword in tokens:
        dot_product += tfidf_dict_qry[keyword] * df[keyword][df['doc'] == doc_num]
        #||Query||
        qry_mod += tfidf_dict_qry[keyword] * tfidf_dict_qry[keyword]
        #||Document||
        doc_mod += df[keyword][df['doc'] == doc_num] * df[keyword][df['doc'] == doc_num]
    qry_mod = np.sqrt(qry_mod)
    doc_mod = np.sqrt(doc_mod)
    #implement formula
    denominator = qry_mod * doc_mod
    cos_sim = dot_product/denominator
     
    return cos_sim

from collections import Iterable
def flatten(lis):
     for item in lis:
        if isinstance(item, Iterable) and not isinstance(item, str):
             for x in flatten(item):
                yield x
        else:        
             yield item
             
def rank_similarity_docs(data):
    cos_sim =[]
    for doc_num in range(0 , len(data)):
        cos_sim.append(cosine_similarity(tfidf_dict_qry, df , vocab , doc_num).tolist())
    return cos_sim
similarity_docs = rank_similarity_docs(documents)
print(list(flatten(similarity_docs)))
# result = pd.DataFrame(similarity_docs, columns=["Result"])
# result_clean = result.fillna(0)
print("Similarity of dataset")
# print(result_clean)
# print(result_clean.iloc[result_clean.idxmax()])

print("============End Of Cosine Similarity=================")



