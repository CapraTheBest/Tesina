package me.belardinelli.tesina.serial;

import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

import jssc.SerialPort;
import jssc.SerialPortEvent;
import jssc.SerialPortEventListener;
import jssc.SerialPortException;

public class Main {
	static SerialPort serialPort;

	public static void main(String[] args) {
		serialPort = new SerialPort("/dev/ttymxc3");
		try {
			System.out.println("port open :" + serialPort.openPort());//Open port
			serialPort.setParams(SerialPort.BAUDRATE_115200,
					SerialPort.DATABITS_8,
					SerialPort.STOPBITS_1,
					SerialPort.PARITY_NONE);

			int mask = SerialPort.MASK_RXCHAR + SerialPort.MASK_CTS + SerialPort.MASK_DSR;//Prepare mask
			serialPort.setEventsMask(mask);//Set mask
			serialPort.addEventListener(new SerialPortReader());//Add SerialPortEventListener
		} catch (SerialPortException ex) {
			System.out.println(ex);
		}
	}

	static class SerialPortReader implements SerialPortEventListener {

		public void serialEvent(SerialPortEvent event) {
			if (event.isRXCHAR()) {//If data is available
				//System.out.println(event.getEventValue());
				if (event.getEventValue() > 4) {//Check bytes count in the input buffer

					//Read data, if 10 bytes available
					try {
						byte buffer[] = serialPort.readBytes(16);
						System.out.println((char)buffer[0] + "" + (char)buffer[1] + "" + (char)buffer[2] + "" + (char)buffer[3] + "" +
								(char)buffer[4] + "" + (char)buffer[5] + "" + (char)buffer[6] + "" + (char)buffer[7] + "" +
								(char)buffer[8] + "" + (char)buffer[9] + "" + (char)buffer[10] + "" + (char)buffer[11] + "" +
								(char)buffer[12] + "" + (char)buffer[13] + "" + (char)buffer[14] + "" + (char)buffer[15] + "" );
						String converted = ((char)buffer[0] + "" + (char)buffer[1] + "" + (char)buffer[2] + "" + (char)buffer[3] + "" +
								(char)buffer[4] + "" + (char)buffer[5] + "" + (char)buffer[6] + "" + (char)buffer[7] + "" +
								(char)buffer[8] + "" + (char)buffer[9] + "" + (char)buffer[10] + "" + (char)buffer[11] + "" +
								(char)buffer[12] + "" + (char)buffer[13] + "" + (char)buffer[14] + "" + (char)buffer[15] + "" );
						writeFile(converted);
					} catch (SerialPortException ex) {
						System.out.println(ex);
					} catch (IOException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
				}
			}
		}
		
		public void writeFile(String converted) throws IOException {
			PrintWriter bw = new PrintWriter(new FileWriter("Log.txt", true));
			DateFormat df = new SimpleDateFormat("yy/MM/dd HH:mm:ss");
			Date dateobj = new Date();
			System.out.println(df.format(dateobj));
			bw.write(converted);
			bw.write(df.format(dateobj) + System.getProperty("line.separator"));
			bw.close();
		}
	}
}