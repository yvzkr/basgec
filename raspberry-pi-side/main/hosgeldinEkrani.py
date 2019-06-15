# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file 'hosgeldinEkrani.ui'
#
# Created: Thu May  4 17:01:17 2017
#      by: PyQt4 UI code generator 4.10.4
#
# WARNING! All changes made in this file will be lost!
from PyQt4.QtCore import pyqtSlot
from PyQt4 import QtCore, QtGui
from PyQt4 import QtDeclarative
import time
from PyQt4.QtCore import *
from PyQt4.QtGui import *
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

class Ui_WaitScreen(QtGui.QWidget):
    closed = pyqtSignal()
    def __init__(self, *args):
        QWidget.__init__(self, *args)
        self.setupUi(self)


    def setupUi(self, WaitScreen):
        WaitScreen.setObjectName(_fromUtf8("WaitScreen"))
        WaitScreen.resize(800, 480)
        self.declarativeView = QtDeclarative.QDeclarativeView(WaitScreen)
        self.declarativeView.setGeometry(QtCore.QRect(-1, -1, 800, 480))
        self.declarativeView.setObjectName(_fromUtf8("declarativeView"))
        self.label = QtGui.QLabel(WaitScreen)
        self.label.setGeometry(QtCore.QRect(160, 140, 501, 161))
        font = QtGui.QFont()
        font.setPointSize(20)
        font.setBold(True)
        font.setWeight(75)
        self.label.setFont(font)
        self.label.setAlignment(QtCore.Qt.AlignCenter)
        self.label.setObjectName(_fromUtf8("label"))

        self.retranslateUi(WaitScreen)
        QtCore.QMetaObject.connectSlotsByName(WaitScreen)
        #WaitScreen.show()
    def retranslateUi(self, WaitScreen):
        WaitScreen.showFullScreen()
        WaitScreen.setWindowTitle(_translate("WaitScreen", "Form", None))
        self.label.setText(_translate("WaitScreen", "Lütfen Kartınızı Okutunuz", None))

    @pyqtSlot()
    def kartBulunamadiMesaji(self):
        self.label.setText("Böyle bir id Bulunamadi")

def main():

    app = QtGui.QApplication(sys.argv)
    showTime = Ui_WaitScreen()
    sys.exit(app.exec_())

if __name__ == "__main__":
    main()
