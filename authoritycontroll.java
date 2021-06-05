package com.wirtshauskartn.testcardscanner;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.os.Vibrator;
import android.util.Base64;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class authoritycontroll extends AppCompatActivity {


    //Objektvariabeln anlegen

    TextView textView1;
    EditText gettogger;
    EditText getbasser;
    String togger;
    String uzibo1;
    String uzibo2;
    String basser;
    Thread Programm2;

    String row;

    String sendeurl;

    String answer ="leider nein";

    boolean flag = false;

    static {
        System.loadLibrary("uzibo");
    }

    public native String getNativeUzibo1();
    public native String getNativeUzibo2();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_authoritycontroll);
        uzibo1 = new String(Base64.decode(getNativeUzibo1(),Base64.DEFAULT));
        uzibo2 = new String(Base64.decode(getNativeUzibo2(),Base64.DEFAULT));
        Programm2 = new Thread(new Runnable() {
            @Override

            public void run() {

                row = "Depp";

                while (true) {

                    if(flag)
                    {
                        flag = false;

                        sendeurl=uzibo2
                        +togger
                        +"&proz="
                        +basser;


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
                                if(answer == null)
                                {answer ="hallo";}
                                if(answer.equals(uzibo1)) {


                                    DisplayDatabase(null);




                                } else {

                                    try {
                                        runOnUiThread(new Runnable() {
                                            @Override
                                            public void run() {
                                                textView1.setText("Falsches Login oder Passwort!\n\nAchten Sie auf Groß- und Kleinschreibung.");
                                            }
                                        });
                                    } catch (Exception ex) {
                                        ex.printStackTrace();
                                    }


                                }
                            } catch (IOException e) {
                                e.printStackTrace();
                            }

                    }

                        try {
                            Thread.sleep(1000);
                        } catch (Exception ex) {
                            ex.printStackTrace();
                        }



                    }
                }

        });

        textView1 = (TextView) findViewById(R.id.textView3);
        //textView1.setText("Hallo");
        gettogger = (EditText) findViewById(R.id.authorityName) ;
        getbasser = (EditText) findViewById(R.id.authorityPass) ;
        Programm2.start();

    }


        public void onClick(View v) {
            Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

            long Pattern[] = {50, 20, 50, 20, 50};
            vib.vibrate(Pattern,-1);
            flag = true;
            togger = gettogger.getText().toString();
            basser = getbasser.getText().toString();
        }


        public void DisplayDatabase (View v){
            Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

            long Pattern[] = {50, 20, 50, 20, 50};
            vib.vibrate(Pattern,-1);
            Intent b;
            b = new Intent(this, DisplayDatabaseContent.class);
            startActivity(b);
        }

    public void GeheZuActivity(View v) {Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        Intent b;
        b = new Intent(this, WirtshausErstellen.class);
        startActivity(b);
    }
}

