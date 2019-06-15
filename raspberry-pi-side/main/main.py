# -*- coding: utf-8 -*-

from PyQt4 import QtCore, QtGui
from hosgeldinEkrani import Ui_WaitScreen
from arayuz import Ui_Form
from arkaplan import ArkaPlan
import serial
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



class MainMenu(QtGui.QWidget):

    def __init__(self,parent=None):
        super(MainMenu, self).__init__(parent)
        self.hosgeldin = Ui_WaitScreen(self)
        self.hosgeldin.showFullScreen()
        self.arkaPlan = ArkaPlan(self)
        self.connect(self.arkaPlan, QtCore.SIGNAL("dogruGiris(QString,QString )"), self.dogruGiris)
        self.connect(self.arkaPlan,QtCore.SIGNAL("hataliGiris(QString )"),self.hataliGiris)
        self.connect(self.arkaPlan, QtCore.SIGNAL("tipEkran ( QString,QString,QString ) "), self.tipEkran)
        self.arkaPlan.baslat()

    def gostermeEkrani(self,kullaniciAdi):
        print "gosterme Ekrani fonksiyonundasin"

        self.hosgeldin.label.setText("")
        QtCore.QTimer.singleShot(500, lambda: self.hosgeldin.label.setText(_translate("WaitScreen", "İyi Günler Dileriz {0} Bey".format(kullaniciAdi), None)))
        QtCore.QTimer.singleShot(3000,lambda: self.hosgeldin.label.setText(_translate("WaitScreen", "Lütfen Kartınızı Okutunuz", None)))
        QtCore.QTimer.singleShot(500, lambda:self.arkaPlan.baslat())

    def hataliGiris(self):
        self.arkaPlan.cikis()
        #self.close()
        #print "Burdasin3"
        #self.mesajEkrani=Ui_WaitScreen()
        #self.mesajEkrani.label.setText("Kart id Bulunamadı")
        #self.mesajEkrani.show()
        #self.mesajEkrani.raise_()
        self.hosgeldin.label.setText("")
        QtCore.QTimer.singleShot(500, lambda: self.hosgeldin.label.setText(_translate("WaitScreen", "Bu Karta Ait Bir Kullanıcı Bulunamadı", None)))
        QtCore.QTimer.singleShot(2000, lambda: self.hosgeldin.label.setText(_translate("WaitScreen", "Lütfen Kartınızı Okutunuz", None)))
        QtCore.QTimer.singleShot(500, lambda:self.arkaPlan.baslat())

    def dogruGiris(self,cardid,kullaniciAdi):
        print "burdayım"
        self.arkaPlan.cikis()
        #self.close()
        #print "Burdasin3"
        #self.mesajEkrani=Ui_WaitScreen()
        #self.mesajEkrani.label.setText("Kart id Bulunamadı")
        #self.mesajEkrani.show()
        #self.mesajEkrani.raise_()
        self.hosgeldin.label.setText("")
        QtCore.QTimer.singleShot(500, lambda: self.hosgeldin.label.setText(_translate("WaitScreen", "Hoşgeldiniz {0} Bey".format(kullaniciAdi), None)))
        QtCore.QTimer.singleShot(2000,lambda: self.hosgeldin.label.setText(_translate("WaitScreen", "Lütfen Kartınızı Okutunuz", None)))
        QtCore.QTimer.singleShot(500, lambda: self.arkaPlan.baslat())

    def tipEkran(self, cardid,personelName,personelSurname):
        print cardid
        print "selam",personelName
        self.tipEkrani = Ui_Form(None,personelName,personelSurname)
        self.tipEkrani.gelenId(cardid,personelName,personelSurname)
        self.tipEkrani.show()
        self.tipEkrani.raise_()
        self.connect(self.tipEkrani, QtCore.SIGNAL("gostermeEkrani(QString )"), self.gostermeEkrani)



app = QtGui.QApplication(sys.argv)
a = MainMenu()
a.showFullScreen()
sys.exit(app.exec_())
