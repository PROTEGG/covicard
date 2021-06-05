package com.wirtshauskartn.testcardscanner;

import android.app.DatePickerDialog;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.Vibrator;
import android.text.Html;
import android.util.Base64;
import android.view.Gravity;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.Calendar;
import java.util.List;

import javax.crypto.Cipher;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;

import static androidx.core.content.FileProvider.getUriForFile;

public class DisplayDatabaseContent extends AppCompatActivity {

    List<Guests> userList;
    Button button;
    String dataToWrite;
    String uzibo1;
    String uzibo2;
    TextView textView;
    String date = null;
    String name;
    String mail;
    DatePickerDialog datePickerDialog;

    static {
        System.loadLibrary("uzibo");
    }

    public native String getNativeUzibo1();
    public native String getNativeUzibo2();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_display_database_content);
        ListView listview;
        listview = findViewById(R.id.listview);

        GuestDatabase userDatabase = GuestDatabase.getInstance(this);
        userList = userDatabase.getGuestDao().getHoleTable();


        ArrayAdapter adapter = new CustomArrayAdapter(getApplicationContext(), R.layout.layoutforview, userList);
        listview.setAdapter(adapter);

    }



    public void GeheZuActivity (View v){

        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);

        Intent b;
        b = new Intent(this, WirtshausErstellen.class);
        startActivity(b);
    }

    public void writeDataToSdCardhost1(View v) throws FileNotFoundException {

        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);

        writeData();
        textView = findViewById(R.id.Pfad2);
        textView.setText(Html.fromHtml("Sie finden jetzt die Datei \n<b>kontaktInfoBeh.csv</b> \n unter Interner Speicher => Android => data => \n com.wirtshauskartn.com.wirtshauskartn.testcardscanner => files "));
    }

    public void writeData()throws FileNotFoundException {

        //******************************************************************************************
        //  Create File to write in
        //******************************************************************************************
        
        File[]  externalstorageVolumes  = ContextCompat.getExternalFilesDirs(getApplicationContext(), null);
        File    path                    = externalstorageVolumes[0];
        File    datei                   = new File(path.getPath(), "kontaktInfoBeh.csv");
        
        //******************************************************************************************
        //  Get uzibos
        //******************************************************************************************
       
        uzibo1 = new String(Base64.decode(getNativeUzibo1(),Base64.DEFAULT));
        uzibo2 = new String(Base64.decode(getNativeUzibo2(),Base64.DEFAULT));

        String edk                      = uzibo1;
        String iv                       = uzibo2;

        //******************************************************************************************
        //  Open database
        //******************************************************************************************

        GuestDatabase userDatabase = GuestDatabase.getInstance(this);

        //******************************************************************************************
        //  Check if user requests a specific day or the hole table and get the number of and the rows
        //  which are requested
        //******************************************************************************************

        int rows = 0;

        if (date != null) {
            rows = userDatabase.getGuestDao().numberOfRowsControlDates(date);
        }
        else
        {
            rows = userDatabase.getGuestDao().numberOfRows();
        }


        String resultOfRow = String.valueOf(rows);
        Toast.makeText(this, resultOfRow+" Kontaktinformationen gespeichert!",
                Toast.LENGTH_LONG).show();



        if (date != null)
        {
            userList = userDatabase.getGuestDao().guestsSelected(date);
        }
        else
        {
            userList = userDatabase.getGuestDao().getHoleTable();
        }

        //******************************************************************************************
        //  Check if user requests a specific day or the hole table and get the number of and the rows
        //  which are requested
        //******************************************************************************************

        try{

            //******************************************************************************************
            //  Open the file which is created above
            //******************************************************************************************

            FileOutputStream os = new FileOutputStream(datei);

            //******************************************************************************************
            //  write header row to file
            //******************************************************************************************

            String ergebnis="";
            String verschlKI ="Name;";
            String mailKi ="E-Mail-Adresse;";
            String tab = "Platz";
            String veri ="Verifikation;";
            String KontrollKI ="Kontrollnr.;";
            String arriDat = "Datum;";
            String KommZeit = "gekommen\n;";
            String leaveTim = "gegangen\n;";


            String rowHeader="Name; E-Mail-Adresse; Verifikation; Kontrollnummer; Datum; gekommen; gegangen; Platz \n\n";

            os.write(rowHeader.getBytes());

            //******************************************************************************************
            //  Get and write data-rows to file
            //******************************************************************************************

            //  get requested rows from database

            for (int i = 0; i < rows; i++) {

                Guests user = userList.get(i);
              
                // get contact detail and decrypt it

                String encryptedData            = user.getEncryptedData();
                String Control;

                if(encryptedData.startsWith("AMAR")){
                    name    = "Luca® Code";
                    mail    = "Luca® Code";
                    Control     = encryptedData;
                }else {
                    try {

                        byte[] encrypted1 = Base64.decode(encryptedData, Base64.DEFAULT);
                        Cipher cipher = Cipher.getInstance("AES/CBC/PKCS5Padding");
                        SecretKeySpec keyspec = new SecretKeySpec(edk.getBytes(), "AES");
                        IvParameterSpec ivspec = new IvParameterSpec(iv.getBytes());

                        cipher.init(Cipher.DECRYPT_MODE, keyspec, ivspec);
                        byte[] original = cipher.doFinal(encrypted1);

                        ergebnis = new String(original);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }

                    // separate e-mail

                    String[] splitErgebnis = ergebnis.split(" ");
                    int numberOfElements = splitErgebnis.length;
                    int numberOfLastItem = numberOfElements - 1;
                    mail = splitErgebnis[numberOfLastItem];

                    // separate name

                   name = splitErgebnis[0];

                    for (int o = 1; o < numberOfLastItem; o++) {
                        name = splitErgebnis[o] + " " + name;
                    }
                }
                // get the rest of data

                String table        = user.getTable_number();
                if(encryptedData.startsWith("AMAR")){
                    Control = encryptedData;
                }else Control        =  user.getControl();
                String flag         = user.getFlag();
                String arrival_date = user.getArrival_date();
                String arrival_time = user.getArrival_time();
                String leave_time   = user.getLeave_time();


                //prepare data to write

                dataToWrite = name+"; "+mail+"; "+flag+"; "+Control+"; "+arrival_date+"; "+arrival_time+"; "+leave_time+"; "+table+"\n";


                //write data to file

                os.write(dataToWrite.getBytes());
            }
            //******************************************************************************************
            //  Close file
            //******************************************************************************************

            os.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void shareData() throws FileNotFoundException {
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        writeData();

        Toast toast = new Toast(this);
        toast.setGravity(Gravity.CENTER_VERTICAL, 0, 500);
        toast.makeText(this, "\nACHTUNG! BEACHTEN SIE DEN DATENSCHUTZ! \n\nWÄHLEN SIE VERSCHLÜSSELTE SENDEMETHODEN\n",
                Toast.LENGTH_LONG).show();

        File[] externalstorageVolumes = ContextCompat.getExternalFilesDirs(getApplicationContext(), null);
        File path=externalstorageVolumes[0];
        File datei=new File (path.getPath(), "kontaktInfoBeh.csv");

        Uri contenturi = getUriForFile(this, "com.wirtshauskartn.testcardscanner.fileprovider", datei);

        Intent intent = new Intent();
        intent.setAction(Intent.ACTION_SEND);
        intent.putExtra(Intent.EXTRA_STREAM, contenturi);
        intent.setType("*/*");
        startActivity(Intent.createChooser(intent, "Beachten Sie die DS-GVO!"));
    }

    public void share (View v) throws FileNotFoundException{
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        try{
            shareData();
        }catch (FileNotFoundException e){
        }
    }

    public void buildDate (View v) throws FileNotFoundException {
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        // calender class's instance and get current date , month and year from calender
        final Calendar c = Calendar.getInstance();
        int mYear = c.get(Calendar.YEAR); // current year
        int mMonth = c.get(Calendar.MONTH); // current month
        int mDay = c.get(Calendar.DAY_OF_MONTH); // current day
        // date picker dialog
        datePickerDialog = new DatePickerDialog(this, R.style.datepicker,
                new DatePickerDialog.OnDateSetListener()  {

                    @Override
                    public void onDateSet(DatePicker view, int year,
                                          int monthOfYear, int dayOfMonth) {
                        // set day of month , month and year value in the edit text
                        if((monthOfYear + 1)>=10) {

                            if ((dayOfMonth) >= 10) {
                                date = (year) + "-" + (monthOfYear + 1) + "-" + dayOfMonth;

                            } else {
                                date = (year) + "-" + (monthOfYear + 1) + "-0" + dayOfMonth;
                            }
                        }
                        if((monthOfYear + 1)<10){
                            if ((dayOfMonth) >= 10) {
                                date = (year) + "-0" + (monthOfYear + 1) + "-" + dayOfMonth;

                            } else {
                                date = (year) + "-0" + (monthOfYear + 1) + "-0" + dayOfMonth;
                            }

                        }



                        try{
                            shareData();
                        }catch (FileNotFoundException e){
                        }

                        date=null;

                    }
                }, mYear, mMonth, mDay);
        datePickerDialog.show();


    }


}