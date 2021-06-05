package com.wirtshauskartn.testcardscanner;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Vibrator;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import java.text.SimpleDateFormat;
import java.util.Calendar;


public class WirtshausErstellen extends AppCompatActivity {

    EditText editText;
    String MailWirtshaus;
    TextView textView;
    Context context;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_wirtshaus_erstellen);



        editText = (EditText) findViewById(R.id.editTischNumber);
        editText.setOnClickListener(myhandler1);
        textView = (TextView) findViewById(R.id.FAQ);

    }

    View.OnClickListener myhandler1 = new View.OnClickListener() {
        public void onClick(View v) {

            String filename = "NameWirtshaus.txt";
            MailWirtshaus = editText.getText().toString();
            textView.setText(MailWirtshaus);




        }
    };

    public void GeheZuActivity (View v){
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        Intent b;
        b = new Intent(this, MainActivity.class);
        startActivity(b);
    }

    public void Geheemergencydelete (View v){
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        Intent b;
        b = new Intent(this, emergencydelete.class);
        startActivity(b);
    }

    public void DisplayDatabase (View v){
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        Intent b;
        b = new Intent(this, authoritycontroll.class);
        startActivity(b);
    }

    public void hostControl (View v){
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        Intent b;
        b = new Intent(this, hostControl.class);
        startActivity(b);
    }

    public void finishAllTables (View v) {
        final GuestDatabase guestDatabase = GuestDatabase.getInstance(this);
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);

        long Pattern[] = {50, 20, 50, 20, 50};
        vib.vibrate(Pattern,-1);
        Calendar kalender = Calendar.getInstance();
        SimpleDateFormat time1 = new SimpleDateFormat("HH:mm:ss");
        String leave_time = time1.format(kalender.getTime());
        guestDatabase.getGuestDao().finishAllTables(leave_time);
    }

    public void changeCamera (View v){
        Vibrator vib = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);
        vib.vibrate(200);
        SharedPreferences daten = getSharedPreferences("Wirtshausname", Context.MODE_PRIVATE);
        Integer CameraValue = daten.getInt("Wirtshaus", 0);
        if (CameraValue==0){
            SharedPreferences.Editor editor = daten.edit();
            editor.putInt("Wirtshaus", 1);
            editor.apply();}
        else {
            SharedPreferences.Editor editor = daten.edit();
            editor.putInt("Wirtshaus", 0);
            editor.apply();
        }
    }
}
