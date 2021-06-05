package com.wirtshauskartn.testcardscanner;

import android.app.DatePickerDialog;
import android.content.Context;
import android.content.Intent;
import android.hardware.camera2.CameraManager;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.Vibrator;
import android.text.Html;
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

import static android.view.Gravity.CENTER_VERTICAL;
import static androidx.core.content.FileProvider.getUriForFile;

public class hostControl extends AppCompatActivity {
    List<Guests> userList;
    Button button;
    String babe;
    String Pfad;
    TextView textView;
    DatePickerDialog datePickerDialog;
    String date = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_host_control);
        ListView listview;
        listview = findViewById(R.id.listview);


        GuestDatabase userDatabase = GuestDatabase.getInstance(this);
        userList = userDatabase.getGuestDao().getHoleTable();


        ArrayAdapter adapter = new CustomArrayAdapterHost(getApplicationContext(), R.layout.layoutforviewhost, userList);
        listview.setAdapter(adapter);

    }


    public void GeheZuActivity(View v) {
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        Intent b;
        b = new Intent(this, WirtshausErstellen.class);
        startActivity(b);
    }

    public void writeDataToSdCardhost(View v) throws FileNotFoundException {Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        writeData();
        textView.setText(Html.fromHtml("Sie finden jetzt die Datei \n<b>kontaktInfoGast.csv</b> \n unter Interner Speicher => Android => data => \n com.wirtshauskartn.com.wirtshauskartn.testcardscanner => files "));
    }

    public void writeData()throws FileNotFoundException {

        File[] externalstorageVolumes = ContextCompat.getExternalFilesDirs(getApplicationContext(), null);
        File path = externalstorageVolumes[0];
        File datei = new File(path.getPath(), "kontaktInfoGast.csv");

        /* try {
             Pfad = externalFile.getCanonicalPath();
        }catch (IOException e) {
            e.printStackTrace();
        }*/

        GuestDatabase userDatabase = GuestDatabase.getInstance(this);
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
        textView = (TextView) findViewById(R.id.Pfad);


        if (date != null)
        {
            userList = userDatabase.getGuestDao().guestsSelected(date);
        }
        else
        {
            userList = userDatabase.getGuestDao().getHoleTable();
        }


        try{
            FileOutputStream os = new FileOutputStream(datei);
            String ergebnis="";

            String verschlKI    ="verschluesselte Kontaktdaten;";
            String arriDat      = "Datum;";
            String KommZeit      = "Uhrzeit\n";

            String rowHeader="Code; Verifikation; Kontrollnummer; Datum; gekommen; gegangen; Platz \n\n";

            os.write(rowHeader.getBytes());




            for (int i = 0; i < rows; i++) {
                Guests user = userList.get(i);
                String encData                  = user.getEncryptedData();
                String encryptedData            = user.getEncryptedData();
                String Control                  = user.getControl();
                String arrival_date             = user.getArrival_date();
                String arrival_time             = user.getArrival_time();
                String leave_time               = user.getLeave_time();
                String table_numer              = user.getTable_number();
                // get the rest of data


                String flag         = user.getFlag();



                //prepare data to write

                String dataToWrite = encryptedData+"; "+flag+"; "+Control+"; "+arrival_date+"; "+arrival_time+"; "+leave_time+"; "+table_numer+"\n";


                os.write(dataToWrite.getBytes());
            }


            os.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void shareData() throws FileNotFoundException {
        writeData();

        Toast toast = new Toast(this);
        toast.setGravity(Gravity.CENTER_VERTICAL, 0, 500);
        toast.makeText(this, "\nACHTUNG! BEACHTEN SIE DEN DATENSCHUTZ! \n\nWÄHLEN SIE EINE VERSCHLÜSSELTE SENDEMETHODE\n",
                Toast.LENGTH_LONG).show();

        File[] externalstorageVolumes = ContextCompat.getExternalFilesDirs(getApplicationContext(), null);
        File path=externalstorageVolumes[0];
        File datei=new File (path.getPath(), "kontaktInfoGast.csv");

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

    public void buildDate (View v) throws FileNotFoundException {Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

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