#!/usr/bin/python3

import re
import sys
import json

#Argumen check
if len(sys.argv) != 4 :
	print ("\n\nPenggunaan\n\tquery.py [cerpen.json] [n] [query]..\n")
	sys.exit(1)

query = sys.argv[3].split(" ")
n = int(sys.argv[2])

with open(sys.argv[1], 'r') as cerpen:
    indexFile = json.load(cerpen)

# query
list_doc = {}
for q in query:
    try:
        for doc in indexFile:
            if q.lower() in doc['judul'].lower() or q.lower() in doc['karya'].lower():
                if doc['judul-href'] in list_doc:
                    list_doc[doc['judul-href']]['score'] += 1
                else:
                    list_doc[doc['judul-href']] = {
                        'judul': doc['judul'],
                        'judul-href': doc['judul-href'],
                        'karya': doc['karya'],
                        'score': 1
                    }
    except:
        continue

# convert to list
list_data = []
for data in list_doc.values():
    list_data.append(data)

# sorting list descending
count = 1
for data in sorted(list_data, key=lambda k: k['score'], reverse=True):
    result = {
        'judul': data['judul'],
        'judul-href': data['judul-href'],
        'karya': data['karya']
    }
    y = json.dumps(result)
    print(y)
    if count == n:
        break
    count += 1
