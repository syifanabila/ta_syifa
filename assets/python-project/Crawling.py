import tweepy as tw
import mysql.connector

consumer_key= 'Itayk323NA3IlHF4RIZSNIByI'
consumer_secret= 'nZ5BTNJ0x6fr1omsSP6wBzwpw8pci5iBspVSvDzrOi2514qOmD'
access_token= '1335061496091484160-PlDbCWYvuUZSwLtRwo789ATMuFF4Z0'
access_token_secret= '9cR8CA1YBGB0fWHKiB1AUX9cMLHtx9EbG9IKOVg2Djvew'

auth = tw.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)
api = tw.API(auth, wait_on_rate_limit=True)


db = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database = "bismillah_ta",
  charset='utf8'
)

for tweet in tw.Cursor(api.search, lang="id", q='sinovac OR astrazeneca OR sinopharm OR pfizer -filter:retweets',
                       since='2021-01-01', tweet_mode='extended').items(250):
    tweet_id = tweet.user.id_str
    created_at = tweet.created_at
    text = tweet.full_text
    # Simpan ke database
    cursor = db.cursor()
    sql = "INSERT INTO dataset1 (tweet_id, created_at, text) VALUES (%s, %s, %s)"
    cursor.execute(sql, (tweet_id, created_at, text.encode('utf-8')))
    db.commit()