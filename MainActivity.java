package com.wirtshauskartn.testcardscanner;

import android.Manifest;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.hardware.Camera;
import android.hardware.camera2.CameraManager;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.os.Vibrator;
import android.text.Html;
import android.util.Base64;
import android.util.SparseArray;
import android.view.KeyEvent;
import android.view.MotionEvent;
import android.view.SurfaceHolder;
import android.view.SurfaceView;
import android.view.View;
import android.view.inputmethod.EditorInfo;
import android.view.inputmethod.InputMethodManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import com.google.android.gms.vision.CameraSource;
import com.google.android.gms.vision.Detector;
import com.google.android.gms.vision.barcode.Barcode;
import com.google.android.gms.vision.barcode.BarcodeDetector;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.lang.reflect.Field;
import java.net.HttpURLConnection;
import java.net.URL;
import java.security.MessageDigest;
import java.text.SimpleDateFormat;
import java.util.Calendar;

import javax.crypto.Cipher;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;

class Flag {
    public static int theo = 0;
}

@SuppressWarnings("JoinDeclarationAndAssignmentJava")
public class MainActivity extends AppCompatActivity {


    //Objektvariabeln anlegen
    SurfaceView surfaceView;
    CameraSource cameraSource;
    TextView textView;
    TextView textView2;
    EditText editText;

    ImageView imageView;
    ImageView imageView3;
    ImageView imageViewControll;
    RelativeLayout layout1;
    Button finishTable;
    Button WirtsHausErstellen;
    BarcodeDetector barcodeDetector;
    private CameraManager mCameraManager;
    private String mCameraId;
    Thread Programm2;
    Thread Programm3;
    String row;
    int CameraValue;
    String qrcode = "";
    String ergebnis = "Luca® Code";
    String qrcodeAlt = "";
    String sendeurl;
    String teil3 = "0";

    String control;
    String encryptedData;
    String tischNummer;
    String information ="Hallo";
    String tischnummer ="1";
    String uzibo1;
    String uzibo2;
    String uzibo3;
    String uzibo4;
    String resultedHash = "";
    String[] switcher;
    String switcherR="";
    String[] splittedqrcode;
    byte [] result;
    String answer;
    int leckmich = 0;
    int flag = 0;
    int flag2 = 0;
    int camFlag = 1;
    int torchFlag = 0;
    int flagControlled = 0;
    int terminFirstflag =0;
    int controllResult = 0;
    public boolean QRCodeerkanntflag = false;
    Handler empfaenger;
    long aktuelleZeit = 0;
    long alteZeit;
    private Object InputMethodManager;

    private void msg(String s) {
        Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
    }
    static {
        System.loadLibrary("uzibo");
    }

    public native String getNativeUzibo1();
    public native String getNativeUzibo2();
    public native String getNativeUzibo3();
    public native String getNativeUzibo4();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        findViewById(R.id.relativeLayout).setOnTouchListener(new View.OnTouchListener() {
            @Override
            public boolean onTouch(View v, MotionEvent event) {
                if (flag2 == 1) {
                    flag2 = 0;
                    InputMethodManager imm = (InputMethodManager) getSystemService(INPUT_METHOD_SERVICE);
                    imm.hideSoftInputFromWindow(getCurrentFocus().getWindowToken(), 0);

                }
                return false;
            }
        });

        final GuestDatabase guestDatabase = GuestDatabase.getInstance(this);
        guestDatabase.getGuestDao().DeleteUser();


        Programm2 = new Thread(new Runnable() {
            @Override

            public void run() {


                while (true) {

                    Vibrator v = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

                    if (qrcodeAlt.equals(qrcode) == false) {

                        qrcodeAlt = qrcode;


                        if (qrcode.length()>4) {
                            encryptedData="";
                            switcherR = "";

                            v.vibrate(200);

                            if(qrcode.startsWith("AMAR")){
                                ergebnis = "Luca® Code";
                                encryptedData = qrcode;
                                control= "Luca® Code";
                                switcherR = "no";
                            }else {

                                splittedqrcode = qrcode.split("-");

                                // get contactdetails

                                 encryptedData = splittedqrcode[1];

                                // get key and salt


                                String encryptionDecryptionKey = uzibo1;
                                String iv = uzibo2;

                                // decrypt contactdetails

                                try {

                                    byte[] encrypted1 = Base64.decode(encryptedData, Base64.DEFAULT);
                                    Cipher cipher = Cipher.getInstance("AES/CBC/PKCS5Padding");
                                    SecretKeySpec keyspec = new SecretKeySpec(encryptionDecryptionKey.getBytes(), "AES");
                                    IvParameterSpec ivspec = new IvParameterSpec(iv.getBytes());
                                    cipher.init(Cipher.DECRYPT_MODE, keyspec, ivspec);
                                    byte[] original = cipher.doFinal(encrypted1);

                                    ergebnis = new String(original);

                                } catch (Exception e) {
                                    e.printStackTrace();
                                }

                                //***********************************************************************
                                // check if token is valid and - in the case it is a tested-card, if token is related to contactdetails
                                //***********************************************************************

                                if (splittedqrcode.length > 2) {

                                    // create hash from contactdetails


                                    String stringToHash = ergebnis;
                                    String salt = uzibo3;


                                    try {
                                        MessageDigest hash = MessageDigest.getInstance("SHA-256");
                                        byte[] digest = hash.digest((stringToHash + salt).getBytes());
                                        resultedHash = new String(Base64.encode(digest, Base64.DEFAULT));
                                        //textView2.setText(resultedHash);
                                    } catch (java.security.NoSuchAlgorithmException e) {
                                    }

                                    // create url for request

                                    splittedqrcode[2] = splittedqrcode[2].replace("+", "%2B");

                                    sendeurl = uzibo4
                                            + splittedqrcode[2]
                                            + "&hash="
                                            + resultedHash;

                                    // send request

                                    try {
                                        URL url1 = new URL(sendeurl);
                                        HttpURLConnection conn1 = (HttpURLConnection) url1.openConnection();
                                        conn1.setRequestMethod("GET");
                                        conn1.setConnectTimeout(2000);
                                        conn1.setReadTimeout(2000);
                                        BufferedReader berny = new BufferedReader(new InputStreamReader(conn1.getInputStream()));
                                        row = berny.readLine();
                                        answer = row;
                                        berny.close();

                                        conn1.disconnect();

                                    } catch (IOException e) {
                                        answer = "ki-nnnnnn";
                                    }

                                    // inform user that token was valid and token was related to contactdetails


                                    //prepare some data
                                    if (answer == "no") {
                                        switcherR = "no";
                                    } else {
                                        switcher = answer.split("-");
                                        switcherR = switcher[0];
                                    }

                                } else {
                                    switcherR = "k";
                                }
                            }

                            runOnUiThread(new Runnable() {
                                @Override
                                public void run() {
                                    textView.setText(ergebnis);
                                }
                            });

                            int numberOfElements = qrcode.length();


                            String flagSwitcher;
                            Calendar calender = Calendar.getInstance();
                            SimpleDateFormat date = new SimpleDateFormat("yyyy-MM-dd");
                            SimpleDateFormat time = new SimpleDateFormat("HH:mm:ss");

                            //if number of digits of scanned data is equal or more than 4 which excludes that it is the table-number and indicates that it is the guest-data
                            //get time and date from android-system and insert them as a new row (which is equal to a new Guests-object)

                            if (numberOfElements >= 4) {


                                String control = "";

                                if (switcherR.equals(" t")) {
                                    imageViewControll.setImageResource(R.drawable.nt);
                                    imageViewControll.setAlpha(255);
                                    control = switcher[1];
                                }
                                if (switcherR.equals(" c")) {
                                    imageViewControll.setImageResource(R.drawable.tv);
                                    imageViewControll.setAlpha(255);
                                    control = "Termin war vereinbart.";
                                }
                                if (switcherR.equals("k")) {
                                    imageViewControll.setImageResource(R.drawable.ob);
                                    imageViewControll.setAlpha(255);
                                    control = "nur Covicard";
                                }
                                if (switcherR.equals("no")) {
                                    imageViewControll.setImageResource(R.drawable.no);
                                    imageViewControll.setAlpha(255);
                                    //control = "keine";
                                }
                                if (switcherR.equals("ki")) {
                                    imageViewControll.setImageResource(R.drawable.kn);
                                    imageViewControll.setAlpha(255);
                                    control = "keine Internetverbindung";
                                }


                                String arrival_date = date.format(calender.getTime());
                                String arrival_time = time.format(calender.getTime());
                                String leave_time = "00:00:00";
                                String table_number = tischnummer;


                                while (flagControlled == 0) {

                                    try {
                                        Thread.sleep(400);
                                    } catch (Exception ex) {
                                        ex.printStackTrace();
                                    }
                                }

                                if (flagControlled == 1) {

                                    flagSwitcher = "zugelassen";
                                    Guests guest = new Guests(encryptedData, control, flagSwitcher, arrival_date, arrival_time, leave_time, table_number);
                                    guestDatabase.getGuestDao().insertGuestData(guest);
                                    v.vibrate(200);
                                }

                                if (flagControlled == 2) {
                                    flagSwitcher = "abgewiesen";
                                    Guests guest = new Guests(encryptedData, control, flagSwitcher, arrival_date, arrival_time, leave_time, table_number);
                                    guestDatabase.getGuestDao().insertGuestData(guest);
                                    v.vibrate(200);
                                }

                                flagControlled = 0;
                                imageViewControll.setAlpha(0);



                            }

                            //if number of digits is less than 4 digits it is likely to be the table-number,
                            //set Variable Tischnummer and display the number on User Interface which is the current screen the user is looking to
                        }
                        else {
                            tischnummer = qrcode;

                            v.vibrate(200);

                            runOnUiThread(new Runnable() {
                                @Override
                                public void run() {
                                    editText.setText(tischnummer);
                                    textView.setText("BEREIT - NÄCHSTER");
                                }
                            });


                        }





                        try {
                            Thread.sleep(1500);
                        } catch (Exception ex) {
                            ex.printStackTrace();
                        }

                        layout1.setBackgroundColor(Color.WHITE);
                        if (CameraValue == 1) {

                        }

                        runOnUiThread(new Runnable() {
                            @Override
                            public void run() {
                                textView.setText("BEREIT - NÄCHSTER");
                            }
                        });


                    }

                    try {
                        Thread.sleep(800);
                    } catch (Exception ex) {
                        ex.printStackTrace();
                    }


                }
            }
        });


        Programm3 = new Thread(new Runnable() {
            @Override

            public void run() {
                while (true) {

                    if (flag == 1) {

                        flag = 0;

                        Vibrator v = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);
                        v.vibrate(200);

                        Calendar kalender = Calendar.getInstance();

                        SimpleDateFormat time = new SimpleDateFormat("HH:mm:ss");
                        String leave_time = time.format(kalender.getTime());

                        guestDatabase.getGuestDao().updateUser(leave_time, tischnummer);

                        runOnUiThread(new Runnable() {
                            @Override
                            public void run() {

                                textView.setText("BEREIT - NÄCHSTER");
                            }
                        });

                    }


                    try {
                        Thread.sleep(1000);
                    } catch (Exception ex) {
                        ex.printStackTrace();
                    }
                }
            }
        });


        Programm2.start();
        Programm3.start();


        if (ContextCompat.checkSelfPermission(this, Manifest.permission.CAMERA)
                != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this,
                    new String[]{Manifest.permission.CAMERA}, 100);


        } else {camFlag=0;}
        //Objekte von Klassen initialisieren

while(camFlag==1){
    if (ContextCompat.checkSelfPermission(this, Manifest.permission.CAMERA)
            == PackageManager.PERMISSION_GRANTED) {camFlag=0; }
}setup();

    }

    public void setup() {
        surfaceView = (SurfaceView) findViewById(R.id.camerapreview);
        textView = (TextView) findViewById(R.id.textView);

        layout1 = (RelativeLayout) findViewById(R.id.relativeLayout);//new RelativeLayout(this);
        editText = (EditText) findViewById(R.id.editTischNumber);
        imageView = (ImageView) findViewById(R.id.imageView11);

        imageView3 = (ImageView) findViewById(R.id.imageView14);
        imageViewControll = (ImageView) findViewById(R.id.imageView5);
        editText.setOnClickListener(myhandler1);
        finishTable = (Button) findViewById(R.id.finishTable);
        finishTable.setOnClickListener(myhandler2);
        WirtsHausErstellen = (Button) findViewById(R.id.menue);

        imageView3.setAlpha(80);
        imageViewControll.setAlpha(0);
        SharedPreferences daten = getSharedPreferences("Wirtshausname", Context.MODE_PRIVATE);
        CameraValue = 1;

        barcodeDetector = new BarcodeDetector.Builder(this)
                .setBarcodeFormats(Barcode.QR_CODE).build();
        cameraSource = new CameraSource.Builder(this, barcodeDetector)
                .setRequestedPreviewSize(640, 480)
                .setFacing(0)
                .setAutoFocusEnabled(true).build();





        uzibo1 = new String(Base64.decode(getNativeUzibo1(), Base64.DEFAULT));
        uzibo2 = new String(Base64.decode(getNativeUzibo2(), Base64.DEFAULT));
        uzibo3 = new String(Base64.decode(getNativeUzibo3(), Base64.DEFAULT));
        uzibo4 = new String(Base64.decode(getNativeUzibo4(), Base64.DEFAULT));

        WirtsHausErstellen.setText("Kontaktinformationen");
        textView.setText("BEREIT - NÄCHSTER");

        editText.setOnEditorActionListener(new TextView.OnEditorActionListener() {
            @Override
            public boolean onEditorAction(TextView v, int actionId, KeyEvent event) {
                boolean handled = false;

                if (actionId == EditorInfo.IME_ACTION_DONE) {

                    Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

                    long Pattern[] = {50, 20, 50, 20, 50};
                    vib.vibrate(Pattern,-1);

                    tischnummer = editText.getText().toString();
                    teil3 = "&table_number=" + tischnummer;
                    //       &table_number=12";
                    String tischNummer = "TISCH ";

                    handled = false;

                }
                return handled;

            }
        });

        surfaceView.getHolder().addCallback(new SurfaceHolder.Callback() {

            @Override
            public void surfaceCreated(SurfaceHolder holder) {
                if (ActivityCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
                    return;
                }
                try {
                    cameraSource.start(holder);
                } catch (IOException e) {
                    e.printStackTrace();
                }

            }


            @Override
            public void surfaceChanged(SurfaceHolder holder, int format, int width, int height) {

            }

            @Override
            public void surfaceDestroyed(SurfaceHolder holder) {
                cameraSource.stop();
            }
        });

        barcodeDetector.setProcessor(new Detector.Processor<Barcode>() {
            @Override
            public void release() {

            }

            @Override
            public void receiveDetections(Detector.Detections<Barcode> detections) {
                final SparseArray<Barcode> qrCodes = detections.getDetectedItems();

                if (qrCodes.size() != 0) {
                    leckmich = 1;
                    textView.post(new Runnable() {
                        @Override
                        public void run() {
                            qrcode = (qrCodes.valueAt(0).displayValue);
                            //textView.setText(qrcode);
                            QRCodeerkanntflag = true;
                            //textView.setText(qrcode);


                        }
                    });

                }
            }
        });

    }

    View.OnClickListener myhandler1 = new View.OnClickListener() {
        public void onClick(View v) {

            flag2=1;
            tischnummer = editText.getText().toString();
            teil3 = "&table_number=" + tischnummer;


        }
    };



    View.OnClickListener myhandler2 = new View.OnClickListener() {
        public void onClick(View v) { Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

            long Pattern[] = {50, 20, 50, 20, 50};
            vib.vibrate(Pattern,-1);
            flag = 1;
        }
    };



    public void GeheZuWirtshaus (View v){


        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);

        Intent i;
        i = new Intent(this, WirtshausErstellen.class);
        startActivity(i);
    }

    public void GeheZuFAQ (View v){

        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);

        Intent i;
        i = new Intent(this, FAQ.class);
        startActivity(i);
    }

    public void checked (View v){

        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);

        flagControlled = 1;
    }

    public void denied (View v){

        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);

        flagControlled = 2;
    }

    public static Camera getCamera(@NonNull CameraSource cameraSource) {
        Field[] declaredFields = CameraSource.class.getDeclaredFields();

        for (Field field : declaredFields) {
            if (field.getType() == Camera.class) {
                field.setAccessible(true);
                try {
                    Camera camera = (Camera) field.get(cameraSource);
                    if (camera != null) {
                        return camera;
                    }

                    return null;
                } catch (IllegalAccessException e) {
                    e.printStackTrace();
                }

                break;
            }
        }

        return null;
    }

    public void torchButton (View v){

        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);

        if (torchFlag == 1) {torchFlag=0;} else {torchFlag=1;}
        if(Build.VERSION.SDK_INT>15) {
            if (torchFlag == 1) {

                try {
                    Camera cam = getCamera(cameraSource);
                    Camera.Parameters params = cam.getParameters();
                    params.setFlashMode(Camera.Parameters.FLASH_MODE_TORCH);
                    cam.setParameters(params);

                    /*CameraManager camManager = (CameraManager) getSystemService(Context.CAMERA_SERVICE);
                    String cameraId = camManager.getCameraIdList()[0];

                    camManager.setTorchMode(cameraId, true);*/
                } catch (Exception e) {
                }
            } else {
                try {
                    Camera cam = getCamera(cameraSource);
                    Camera.Parameters params = cam.getParameters();
                    params.setFlashMode(Camera.Parameters.FLASH_MODE_OFF);
                    cam.setParameters(params);
                } catch (Exception e) {
                }
            }
        }
    }
}
