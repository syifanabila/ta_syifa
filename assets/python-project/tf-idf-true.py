import math
import numpy as np
import pandas as pd
import mysql.connector
from sklearn.feature_extraction.text import TfidfVectorizer
from mysql.connector import Error

global id_query
# Connect to database
db = mysql.connector.connect(host='localhost',
							 database='2107-reqtacosin-syifa',
							 user='root',
							 password='',
							 charset='utf8'
							 )

getDb = pd.read_sql_query("select tweet from prepro1", db)
df = pd.DataFrame(getDb)
# print(df)
corpus = df["tweet"].values.tolist()
# print("Dataset to list :\n", corpus)
# for row in corpus:
# print(row)

# vectorize = TfidfVectorizer()
# x = vectorize.fit_transform(df['tweet'])
# print(x.shape)
# vocab = vectorize.get_feature_names()
# print("Kumpulan Kata :\n", vocab)
# print("\n")

print("input your keyword :")
inp = input()
vocab = inp.split(" ")

"""
   connect to MySQL database and set query
   """
try:
	if db.is_connected():
		"""
        Insert data query
        """
		cursor = db.cursor()
		# twitter, golf
		query = f"INSERT INTO set_query (keyword) VALUES ('{inp}')"
		cursor.execute(query)

		id_query = cursor.getlastrowid()
		db.commit()

except Error as e:
	print(e)

cursor.close()


# db.close()


# TF
def compute_tf(corpus):
	for doc in corpus:

		kata_tf = []
		jumlah_tf = []
		doc1_lst = doc.split(" ")

		wordDict_1 = dict.fromkeys(set(doc1_lst), 0)
		for token in doc1_lst:

			wordDict_1[token] += 1
			if len(kata_tf) == 0:
				kata_tf.append(token)
			else:
				try:
					kata_tf.index(token)
				except:
					kata_tf.append(token)

		# hitung masing-masing jml
		for kata in kata_tf:

			jml = 0
			for find in doc1_lst:

				if kata == find:
					jml += 1

			jumlah_tf.append(str(jml))

		df = pd.DataFrame([wordDict_1])
		idx = 0
		new_col = ["Term Frequency"]
		df.insert(loc=idx, column='Dataset', value=new_col)

		# print(df)
		divideKata = "-".join(kata_tf)
		divideValue = "-".join(jumlah_tf)

		"""
        Insert data query
        """
		cursor = db.cursor()
		query = f"INSERT INTO term_frequency (id_query, text, tf) VALUES ('{id_query}','{divideKata}', '{divideValue}')"
		cursor.execute(query)

		db.commit()
		cursor.close()


compute_tf(corpus)


# Normalized Term Frequency
def termFrequency(term, document):
	normalizeDocument = document
	return normalizeDocument.count(term.lower()) / float(len(normalizeDocument))


def compute_normalizedtf(corpus):
	tf_doc = []

	for txt in corpus["tweet"]:
		sentence = txt.split()
		norm_tf = dict.fromkeys(set(sentence), 0)

		kata_arr = []
		nilai = []

		for word in sentence:
			norm_tf[word] = termFrequency(word, txt)

			if len(kata_arr) == 0:
				kata_arr.append(word)
				nilai.append(str(termFrequency(word, txt)))
			else:
				try:
					kata_arr.index(word)
				except:
					kata_arr.append(word)
					nilai.append(str(termFrequency(word, txt)))

		# print(kata_arr)
		# print(nilai)
		tf_doc.append(norm_tf)
		df = pd.DataFrame([norm_tf])
		idx = 0
		new_col = ["Normalized TF"]
		df.insert(loc=idx, column='Dataset', value=new_col)
		# print(df)

		# insert
		divideKata = "-".join(kata_arr)
		divideValue = "-".join(nilai)

		"""
        Insert data query
        """
		cursor = db.cursor()
		query = f"INSERT INTO normalize_term_frequency (id_query, text, normalize_tf) VALUES ('{id_query}','{divideKata}', '{divideValue}')"
		cursor.execute(query)

		db.commit()
		cursor.close()

	return tf_doc


tf_doc = compute_normalizedtf(df)


# Inverse Document Frequency (IDF)
def inverseDocumentFrequency(term, allDocuments):
	numDocumentsWithThisTerm = 0
	for doc in range(0, len(allDocuments)):
		if term.lower() in allDocuments[doc].lower().split():
			numDocumentsWithThisTerm = numDocumentsWithThisTerm + 1

	if numDocumentsWithThisTerm > 0:
		return 1.0 + math.log(float(len(allDocuments)) / numDocumentsWithThisTerm)
	else:
		return 1.0


def compute_idf(corpus):
	idf_dict = {}

	kata_arr = []
	nilai = []
	for doc in corpus:
		sentence = doc.split()
		for word in sentence:
			idf_dict[word] = inverseDocumentFrequency(word, corpus)

			if len(kata_arr) == 0:
				kata_arr.append(word)
				nilai.append(str(inverseDocumentFrequency(word, corpus)))
			else:
				try:
					kata_arr.index(word)
				except:
					kata_arr.append(word)
					nilai.append(str(inverseDocumentFrequency(word, corpus)))

	# print("Jumlah Kata " + str(len(kata_arr)))
	# print("Jumlah Nilai " + str(len(nilai)))


	for i in range( len(kata_arr) ):

		kata = kata_arr[i]
		idf  = nilai[i]

		"""
		   Insert data query
		"""
		cursor = db.cursor()
		query = f"INSERT INTO idf (id_query, kata, idf) VALUES ('{id_query}','{kata}', '{idf}')"
		cursor.execute(query)

		db.commit()
		cursor.close()

	
	return idf_dict


idf_dict = compute_idf(corpus)
idf_in = list(idf_dict.items())
to_array = np.array(idf_in)
df_idf_inv = pd.DataFrame(to_array)
print("\n\nInverse Document Frequency (IDF)\n", df_idf_inv)


# tf-idf score across all docs for the query string("life learning")
def compute_tfidf_with_alldocs(corpus, vocab):
	tf_idf = []
	index = 0
	query_tokens = [i.split('\t', 1)[0] for i in vocab]
	df = pd.DataFrame(columns=['doc'] + query_tokens)
	for doc in documents:

		score = 0.0
		df['doc'] = np.arange(0, len(corpus))
		doc_num = tf_doc[index]
		sentence = doc.split()
		for word in sentence:
			for text in query_tokens:
				if (text == word):
					idx = sentence.index(word)
					tf_idf_score = doc_num[word] * idf_dict[word]
					tf_idf.append(tf_idf_score)
					score = tf_idf_score

					df.iloc[index, df.columns.get_loc(word)] = tf_idf_score
					# print(f"Hasil {tf_idf_score}")


		"""
			Insert data query
		"""
		cursor = db.cursor()
		query = f"INSERT INTO term_query (id_query, document, keyword) VALUES ('{id_query}','{index}', '{score}')"
		cursor.execute(query)

		db.commit()
		cursor.close()

		index += 1
	df.fillna(0, axis=1, inplace=True)
	return tf_idf, df


documents = corpus
tf_idf, df = compute_tfidf_with_alldocs(corpus, vocab)
print("\n", df)


# Normalized TF for the query string("life learning")
def compute_query_tf(vocab):
	query_norm_tf = {}
	tokens = vocab
	for word in tokens:
		query_norm_tf[word] = termFrequency(word, vocab)

	return query_norm_tf


query_norm_tf = compute_query_tf(vocab)
data = list(query_norm_tf.items())
q_tf = np.array(data)

for row in q_tf:
	teks = row[0]
	value = row[1]

	"""
	Insert data query
	"""
	cursor = db.cursor()
	query = f"INSERT INTO hasil_query (id_query, query_type,  res_query, res_value) VALUES ('{id_query}', 'TF','{teks}', '{value}')"
	cursor.execute(query)

	db.commit()
	cursor.close()

df_qtf = pd.DataFrame(q_tf)
print("\nQuery TF :\n", df_qtf)


# idf score for the query string
def compute_query_idf(vocab):
	idf_dict_qry = {}
	sentence = vocab
	documents = corpus
	for word in sentence:
		idf_dict_qry[word] = inverseDocumentFrequency(word, documents)
	return idf_dict_qry


idf_dict_qry = compute_query_idf(vocab)
print("\nQuery IDF :")
data = list(idf_dict_qry.items())
an_array = np.array(data)

for row in an_array:
	teks = row[0]
	value = row[1]

	"""
	Insert data query
	"""
	cursor = db.cursor()
	query = f"INSERT INTO hasil_query (id_query, query_type,  res_query, res_value) VALUES ('{id_query}', 'IDF','{teks}', '{value}')"
	cursor.execute(query)

	db.commit()
	cursor.close()

df_idf = pd.DataFrame(an_array)
print(df_idf)


# tf-idf score for the query string
def compute_query_tfidf(vocab):
	tfidf_dict_qry = {}
	sentence = vocab
	for word in sentence:
		tfidf_dict_qry[word] = query_norm_tf[word] * idf_dict_qry[word]
	return tfidf_dict_qry


tfidf_dict_qry = compute_query_tfidf(vocab)
tfidf_vocab = list(tfidf_dict_qry.items())
tfidf_ar = np.array(data)

for row in tfidf_ar:
	teks = row[0]
	value = row[1]

	"""
	Insert data query
	"""
	cursor = db.cursor()
	query = f"INSERT INTO hasil_query (id_query, query_type,  res_query, res_value) VALUES ('{id_query}', 'TF-IDF','{teks}', '{value}')"
	cursor.execute(query)

	db.commit()
	cursor.close()


df_tfidfv = pd.DataFrame(tfidf_ar)
print("TF-IDF vocab :\n\n", df_tfidfv)

# COSINE SIMILARITY
# Cosine Similarity(Query,Document1) = Dot product(Query, Document1) / ||Query|| * ||Document1||

"""
Example : Dot roduct(Query, Document1) 

     Query
     =tfidf(learning w.r.t query) * tfidf(learning w.r.t Document1)/
     sqrt(tfidf(learning w.r.t query)) * 
     sqrt(tfidf(learning w.r.t doc1))

"""


def cosine_similarity(tfidf_dict_qry, df, vocab, doc_num):
	dot_product = 0
	qry_mod = 0
	doc_mod = 0
	tokens = vocab

	for keyword in tokens:
		dot_product += tfidf_dict_qry[keyword] * df[keyword][df['doc'] == doc_num]
		# ||Query||
		qry_mod += tfidf_dict_qry[keyword] * tfidf_dict_qry[keyword]
		# ||Document||
		doc_mod += df[keyword][df['doc'] == doc_num] * df[keyword][df['doc'] == doc_num]
	qry_mod = np.sqrt(qry_mod)
	doc_mod = np.sqrt(doc_mod)
	# implement formula
	denominator = qry_mod * doc_mod
	cos_sim = dot_product / denominator

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
	cos_sim = []
	for doc_num in range(0, len(data)):

		result = cosine_similarity(tfidf_dict_qry, df, vocab, doc_num).tolist()

		hasil = 0
		if math.isnan(result[0]) == False:
			hasil = result

		# print(f"Hasilnya {result[0]}")

		cos_sim.append( hasil )
	return cos_sim


similarity_docs = rank_similarity_docs(documents)
hasil = list(flatten(similarity_docs))
print(hasil)

insert_data_cosine = '-'.join(map(str, hasil))
"""
Insert data query
"""
cursor = db.cursor()
query = f"INSERT INTO cosine_similarity (id_query, data) VALUES ('{id_query}','{insert_data_cosine}')"
cursor.execute(query)

db.commit()
cursor.close()
# result = pd.DataFrame(similarity_docs, columns=["Result"])
# result_clean = result.fillna(0)
print("Similarity of dataset")
# print(result_clean)
# print(result_clean.iloc[result_clean.idxmax()])

print("============End Of Cosine Similarity=================")
db.close()
