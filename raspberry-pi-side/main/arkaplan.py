# -*- coding: utf-8 -*-
from PyQt4 import QtCore, QtGui
import serial
import requests


class ArkaPlan(QtCore.QThread):
    def __init__(self, parent=None):
        QtCore.QThread.__init__(self, parent)
        self.code = ''
        self.geciciVeri = ''
        self.url = ''
        self.test = ''
        self.hataliGiris = ''
        self.dogruGiris = ''

    def cikis(self):
        self.quit()

    def baslat(self):
        self.start()

    def run(self):
        self.serial = serial.Serial("/dev/ttyUSB0", baudrate=9600)
        self.code = ''
        while True:
            self.data = self.serial.read()
            if self.data == '\r':
                self.test = self.code
                self.code = ''
                break
            else:
                self.bufferD = self.data.encode("ascii")
                if self.bufferD == '\n' or self.bufferD == '\x03' or self.bufferD == '\x02':
                    continue
                else:
                    self.code = self.code + self.data
        self.serial.close()
        print self.test
        self.url = "http://192.168.1.5:8081/bas_gec/card_activities/find"
        self.gonderilecekBilgiler = {'card_uid': self.test}
        self.res = requests.post(self.url, data=self.gonderilecekBilgiler)
        # print self.res.text

        self.geciciArray = self.res.json()
        print self.geciciArray["status"]
        #print self.geciciArray["isim"]
        if self.geciciArray["status"] == 1:
            self.emit(QtCore.SIGNAL("tipEkran( QString,QString,QString )"), self.test,self.geciciArray["personelName"],self.geciciArray["personelSurname"])
        elif self.geciciArray["status"] == 2:

            # self.url = "http://192.168.1.42:8081/bas_gec/card_activities/new"
            # self.gonderilecekBilgiler = {'card_uid': self.test,'activities_id':1}
            # self.res = requests.post(self.url, data=self.gonderilecekBilgiler)
            # print self.res.json()
            self.emit(QtCore.SIGNAL("dogruGiris(QString,QString )"), self.test,self.geciciArray["personelName"])
            print "Ana Ekranda Hoşgeldiniz Basacak Sinyali oluştur"
        elif self.geciciArray["status"] == 0:
            print "Ana Ekranda Kart Bulunamadı Uyarısı Gonderen Sinyali Olustur"
            self.emit(QtCore.SIGNAL("hataliGiris(QString)"), self.hataliGiris)

        self.geciciArray = ''
