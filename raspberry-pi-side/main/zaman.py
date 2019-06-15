#!/usr/bin/env python
#-*- coding:utf-8 -*-
import time
from PyQt4 import QtCore, QtGui
class timerThread(QtCore.QThread):
    timeElapsed = QtCore.pyqtSignal(int)

    def __init__(self, parent=None):
        super(timerThread, self).__init__(parent)
        self.timeStart = None

    def start(self, timeStart):
        self.timeStart = timeStart
        return super(timerThread, self).start()

    def run(self):
        while self.parent().isRunning():

            self.timeElapsed.emit(9-(time.time() - self.timeStart))
            #print time.time()
            #print self.timeStart
            #print (6-(time.time() - self.timeStart))
            time.sleep(1)


class myThread(QtCore.QThread):
    timeElapsed = QtCore.pyqtSignal(int)
    def __init__(self, parent=None):
        self.close = False
        super(myThread, self).__init__(parent)
        self.timerThread = timerThread(self)
        self.timerThread.timeElapsed.connect(self.timeElapsed.emit)

    def cikis(self):
        self.timerThread.quit()

    def run(self):

        self.timerThread.start(time.time())
        iterations = 4
        while iterations:
            if self.close == True:
                break
            else:
                #print "Running {0}".format(self.__class__.__name__)
                iterations -= 1
                time.sleep(2)

