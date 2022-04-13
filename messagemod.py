import pywhatkit as pwt
import datetime
# Module Imports
import mariadb
import sys
import time

# Connect to MariaDB Platform
try:
    conn = mariadb.connect(
        user="root",
        password="",
        host="localhost",
        port=3310,
        database="absys"

    )
except mariadb.Error as e:
    print(f"Error connecting to MariaDB Platform: {e}")
    sys.exit(1)

# Get Cursor

cur = conn.cursor()
# retrieving data
cur.execute("SELECT numero_parents,id_abs FROM stagiaire AS S,etat_absence AS E WHERE S.id_st = E.id_st AND message_state = false ;")
result = cur.fetchall()
print(result)

for x in result:
    tel = x[0]
    id_abs = int(x[1])
    print(tel)
    print(id_abs)
    now = datetime.datetime.now()
    print("sending the message")
    pwt.sendwhatmsg(tel, "this is a test ", now.hour, now.minute + 2, 10, True, 5)
    print("wait for 5 seconds ")
    time.sleep(5)
    cur.execute("UPDATE etat_absence set message_state = true where id_abs = ?;",(id_abs,))
    conn.commit()
    print("message statut is true")
conn.close()



