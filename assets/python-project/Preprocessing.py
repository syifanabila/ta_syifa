import pandas as pd
import re
import mysql.connector
from mysql.connector import Error
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory

def get_mysql():
    try:
        connection = mysql.connector.connect(host='localhost',
                                             database='bismillah_ta',
                                             user='root',
                                             password='',
                                             charset='utf8')

        sql_select_Query = "select text from dataset_ta"
        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        # get all records
        records = cursor.fetchall()
        print("Total number of rows in table: ", cursor.rowcount)

        print("\nPrinting each row")

    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if  connection.is_connected():
            connection.close()
            cursor.close()
            print("MySQL connection is closed")

            return records

#regex tweet cleaner
def text_cleaner(text):
    dataFrameSlangword = pd.read_excel('tbl_slangword_1725.xls')
    factory = StopWordRemoverFactory()
    stopword = factory.create_stop_word_remover()
    factory_stem = StemmerFactory()
    stemmer = factory_stem.create_stemmer()

    regex = re.compile('[^a-zA-Z]')  # letter only
    regex_2 = re.compile('\s+')  # remove more than one spaces to only one space
    # Letter only process
    text = re.sub(r'http\S+', '', text) #remove url
    text = regex.sub(' ', text)
    text = regex_2.sub(' ', text)
    text = (text).lstrip(' ')  # remove leading space
    text = stopword.remove(text)  # stopword
    text = stemmer.stem(text)  # stemming


    # Mengubah slangword
    dataFrameStopword = pd.read_excel('stopword.xls')

    for index in range(len(dataFrameStopword['stopword'])):
        if dataFrameStopword['stopword'][index] in text:
            text = re.sub(r'\b{}\b'.format(dataFrameStopword['stopword'][index]), '', text)

    return text

#mysql connect to insert
def insert_mysql(tweet, tag=0):
    """
    connect to MySQL database and insert twitter data
    """
    try:
        con = mysql.connector.connect(host='localhost', database='bismillah_ta', user='root', 
                                      password='', charset='utf8')

        if con.is_connected():
            """
            Insert twitter data
            """
            cursor = con.cursor()
            # twitter, golf
            query = "INSERT INTO prepro_jenis (tweet, tag) VALUES (%s, %s)"
            cursor.execute(query, (tweet, tag))
            con.commit()

    except Error as e:
        print(e)

    cursor.close()
    con.close()

    return

# ===================================================== end of function


#isi list
tweet_list= [] # Lists to be added as columns(Tweets Text) in our dataframe

data_twitter = get_mysql()

for row in data_twitter:
    text_tweet = text_cleaner(row[0])
    tweet_list.append(text_tweet)
    print(text_tweet)

print("======= Preprocessing Finish =========")

df_twitter = pd.DataFrame({'tweet':tweet_list})

df_twitter['tweet'] = df_twitter['tweet'].str.lower() #casefolding

for row in df_twitter.itertuples():
    insert_mysql(row[1], tag=1)
    # print(row[1])
