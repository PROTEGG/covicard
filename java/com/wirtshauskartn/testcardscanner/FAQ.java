package com.wirtshauskartn.testcardscanner;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.text.method.ScrollingMovementMethod;
import android.view.View;
import android.widget.TextView;

public class FAQ extends AppCompatActivity {

    TextView textview;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_faq);

        textview = (TextView) findViewById(R.id.FAQ);
        textview.setMovementMethod(new ScrollingMovementMethod());

        textview.setText(getText(R.string.faq));

    }

    public void GeheZuMain (View v){
        Intent i;
        i = new Intent(this, MainActivity.class);
        startActivity(i);
    }
}
