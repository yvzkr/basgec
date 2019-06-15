# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file 'arayuz.ui'
#
# Created: Wed May  3 19:58:17 2017
#      by: PyQt4 UI code generator 4.10.4
#
# WARNING! All changes made in this file will be lost!

from PyQt4 import QtCore, QtGui
from PyQt4.QtCore import pyqtSlot
from hosgeldinEkrani import Ui_WaitScreen
from zaman import myThread
import requests
import sys

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    def _fromUtf8(s):
        return s

try:
    _encoding = QtGui.QApplication.UnicodeUTF8
    def _translate(context, text, disambig):
        return QtGui.QApplication.translate(context, text, disambig, _encoding)
except AttributeError:
    def _translate(context, text, disambig):
        return QtGui.QApplication.translate(context, text, disambig)

class Ui_Form(QtGui.QWidget):
    onaylandiSinyali = QtCore.pyqtSignal()
    activityTypes         = [(1, 'Giriş'),(2, 'İzinli'),(3, 'Ücretsiz İzinli'),
                            (4, 'Hasta'),(5, 'Raporlu'),(6, 'Görevli'),
                            (7, 'Şehir Dışı Görev'),(8, 'Dış Görev'),(9, 'Çıkış')]
    acceptArray           = [(10,'Onay'),(11,'İptal')]
    buttonAcceptNames     = ['Onay','İptal']
    buttonTypeObjectsName = ['girisButonu', 'izinliButonu', 'ucretsizIzinliButonu',
                             'hastaButonu', 'raporluButonu', 'gorevliButonu',
                             'sehirDisiGorevButonu', 'disGorevButonu', 'cikisButonu']

    def  __init__(self,parent=None,kullaniciAdi='',kullaniciSoyadi=''):
        super(Ui_Form,self).__init__(parent)
        self.gelen = ''
        self.personelName=''
        self.kullaniciAdi=str(kullaniciAdi.toUtf8())
        self.kullaniciSoyadi=str(kullaniciSoyadi.toUtf8())
        self.x=340
        self.y=20
        self.setupUi(self)
        self.liste=[]#yavuz

        #self.connect(QtGui.QWidget,QtCore.SIGNAL("onaylandi(QString )"), self.onaylandi)
        self.onaylandiSinyali.connect(self.onaylandi)
    def sifirla(self):
        self.x=0
        self.y=0
    def setupUi(self,Form):
        Form.setObjectName(_fromUtf8("Form"))
        Form.resize(800, 480)
#--------Font Definition(start)----------------#
        self.font = QtGui.QFont()
        self.font.setPointSize(12)
        self.font.setBold(True)
        self.font.setWeight(75)
#--------Font Definition(End)-------------------#
        self.myThread = myThread()
        self.buton_group = QtGui.QButtonGroup(self)
        self.buton_group2 = QtGui.QButtonGroup(self)

        self.myThread.timeElapsed.connect(self.on_myThread_timeElapsed)
        self.myThread.finished.connect(self.on_myThread_finished)
        self.myThread.start()



        self.buton_group2.buttonClicked['int'].connect(self.tipSecildi)
        self.buton_group.buttonClicked['int'].connect(self.secili)
        self.buton_group.buttonClicked['int'].connect(self.tipSecildi)
        self.sayac = 0
        for i in range(3):
            for j in range(3):
                self.id2_=self.activityTypes[self.sayac][0]
                self.buton= QtGui.QPushButton(self.activityTypes[self.sayac][1],self)
                self.buton.setGeometry(QtCore.QRect(self.x, self.y, 140, 140))
                self.buton.setFont(self.font)
                self.buton.setObjectName(_fromUtf8("self.buttonTypeObjectsName[self.sayac]"))
                self.buton_group.addButton(self.buton,self.id2_)
                self.x += 150
                self.sayac+=1
            self.y += 150
            self.x  = 340
        self.sifirla()

        for i in range(2):
            self.y=20
            self.id_=self.acceptArray[i][0]
            self.buton2 = QtGui.QPushButton(self.acceptArray[i][1], self)
            self.buton2.setDisabled(True)
            self.buton2.setGeometry(QtCore.QRect(self.x, self.y, 140, 140))
            self.buton2.setFont(self.font)
            self.buton2.setObjectName(_fromUtf8("self.buttonAcceptNames[i]"))
            self.buton_group2.addButton(self.buton2, self.id_)
            self.x += 150
        self.font = QtGui.QFont()
        self.font.setPointSize(18)
        self.font.setBold(True)
        self.font.setWeight(75)
#----------------Kullanıcı Bilgileri-------------#
        self.kullaniciBilgileri = QtGui.QLabel(Form)
        self.kullaniciBilgileri.setEnabled(True)
        self.kullaniciBilgileri.setGeometry(QtCore.QRect(10, 260, 330, 80))
        self.kullaniciBilgileri.setFont(self.font)
        self.kullaniciBilgileri.setAlignment(QtCore.Qt.AlignCenter)
        self.kullaniciBilgileri.setObjectName(_fromUtf8("mesajEtiketi"))
# ----------------Kullanıcı Bilgileri-------------#
# ------------------MesajEtiketi-----------------#
        self.mesajEtiketi = QtGui.QLabel(Form)
        self.mesajEtiketi.setEnabled(True)
        self.mesajEtiketi.setGeometry(QtCore.QRect(10, 320, 330, 80))
        self.mesajEtiketi.setFont(self.font)
        self.mesajEtiketi.setAlignment(QtCore.Qt.AlignCenter)
        self.mesajEtiketi.setObjectName(_fromUtf8("mesajEtiketi"))
# ------------------MesajEtiketi-----------------#

        self.retranslateUi(Form)
        QtCore.QMetaObject.connectSlotsByName(Form)
        Form.show()
    def gelenId(self,card_uid,personelName,personelSurname):
        self.gelen=str(card_uid)
        self.personelName=personelName.toUtf8()
        self.personelSurname=personelSurname.toUtf8()
        print self.personelName
    def onaylandi(self):
        self.close()
        #self.sayGoodBye=Ui_WaitScreen()
        #self.sayGoodBye.label.setText("Hoscakal")
        #self.sayGoodBye.show()
        #self.sayGoodBye.raise_()
        self.gostermeEkrani=self.kullaniciAdi
        self.emit(QtCore.SIGNAL("gostermeEkrani(QString )"), self.gostermeEkrani)
        #self.close()
        #self.goodByeSceen =Ui_WaitScreen()
        #self.goodByeSceen.sayGoodBye()
        #self.goodByeSceenshow()
        #self.goodByeSceen.raise_()

    def update_label(self):
        current_time = str(datetime.datetime.now().time())
        self.label.setText(current_time)
    @QtCore.pyqtSlot(int)
    def on_myThread_timeElapsed(self, seconds):
        print "B"
        self.mesajEtiketi.setText(_translate("Form", "{0}".format(seconds), None))
    @QtCore.pyqtSlot()
    def on_myThread_finished(self):
        if self.myThread.close != True:
            self.card_type_id=9
            self.url = "http://192.168.1.5:8081/bas_gec/card_activities/new"
            self.gonderilecekBilgiler = {'card_uid': self.gelen, 'activities_id':self.card_type_id}
            self.res = requests.post(self.url, data=self.gonderilecekBilgiler)
            self.geciciArray = self.res.json()
            if self.geciciArray["status"] == 1:
                self.onaylandiSinyali.emit()
            if self.geciciArray["status"] == 0:
                print "hata"
        else:
            print "hata2"
    @pyqtSlot(QtGui.QAbstractButton)
    def tipSecildi(self, id_):
        print type(id_)
        self.liste.append(id_)
        self.button = self.buton_group.button(id_)
        if id_ == self.acceptArray[0][0]:
            self.url ="http://192.168.1.5:8081/bas_gec/card_activities/new"
            self.gonderilecekBilgiler = {'card_uid':self.gelen, 'activities_id':self.liste[-2]}
            self.liste.pop()
            self.res = requests.post(self.url, data=self.gonderilecekBilgiler)
            print "burdayim",self.res.text
            self.geciciArray = self.res.json()
            if self.geciciArray["status"] == 1:
                self.myThread.close = True
                self.onaylandiSinyali.emit()
            if self.geciciArray["status"] == 0:
                self.myThread.close = True
                print "hata"
        elif id_ == self. acceptArray[1][0]:
            for x in self.activityTypes:
                self.buton_group.button(x[0]).setEnabled(True)
            for x in self.acceptArray:
                self.buton_group2.button(x[0]).setEnabled(False)
        #self.buton_group2.buttonClicked['int'].connect(self.tipSecildi)
    @pyqtSlot(QtGui.QAbstractButton)
    def secili(self,id_):
        print id_
        self.x = 10
        self.y = 20
        self.button = self.buton_group.button(id_)
        for x in self.activityTypes:
            if id_ == x[0]:
                continue
            else:
                self.buton_group.button(x[0]).setEnabled(False)
        for x in self.acceptArray:
            self.buton_group2.button(x[0]).setEnabled(True)
        #self.buton_group2.buttonClicked['int'].connect(self.tipSecildi)
    def retranslateUi(self, Form):
        Form.showFullScreen()
        Form.setWindowTitle(_translate("Form", "Form", None))
        self.sira=0
        for x in self.activityTypes:
            self.buton_group.button(x[0]).setText(_translate("Form",self.activityTypes[self.sira][1], None))
            self.sira+=1
        self.sira=0
        for x in self.acceptArray:
            self.buton_group2.button(x[0]).setText(_translate("Form", self.acceptArray[self.sira][1], None))
            self.sira+=1
        self.kullaniciBilgileri.setText(_translate("Form","{0} {1}".format(self.kullaniciAdi,self.kullaniciSoyadi), None))

        #self.girisButonu.setText(_translate("Form", "Giriş", None))
        #self.izinliButonu.setText(_translate("Form", "İzinli", None))
        #self.ucretsizIzinliButonu.setText(_translate("Form", "Ücretsiz İzinli", None))
        #self.hastaButonu.setText(_translate("Form", "Hasta", None))
        #self.raporluButonu.setText(_translate("Form", "Raporlu", None))
        #self.gorevliButonu.setText(_translate("Form", "Görevli", None))
        #self.sehirDisiGorevButonu.setText(_translate("Form", "Şehir Dışı Görev", None))
        #self.disGorevButonu.setText(_translate("Form", "Dış Görev", None))
        #self.cikisButonu.setText(_translate("Form", "Çıkış", None))
        #self.onayButonu.setText(_translate("Form", "Onay", None))
        #self.iptalButonu.setText(_translate("Form", "İptal", None))


def main():

    app = QtGui.QApplication(sys.argv)
    Ui_Form()
    sys.exit(app.exec_())


