package com.wirtshauskartn.testcardscanner;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

public class emergencydelete extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_emergencydelete);

    }

    public void loescheAlles (View v){
        final GuestDatabase guestDatabase = GuestDatabase.getInstance(this);
        guestDatabase.getGuestDao().DeleteAll();
        Toast.makeText(this, "ALLES GELÖSCHT!",
                Toast.LENGTH_LONG).show();
    }

    public void GeheZuWirtshausErstellen (View v){
        Intent i;
        i = new Intent(this, WirtshausErstellen.class);
        startActivity(i);
    }

}
