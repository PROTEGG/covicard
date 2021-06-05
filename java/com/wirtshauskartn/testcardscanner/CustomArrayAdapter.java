package com.wirtshauskartn.testcardscanner;

import android.content.Context;
import android.util.Base64;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.List;

import javax.crypto.Cipher;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;


public class CustomArrayAdapter extends ArrayAdapter<Guests> {
    private Context context;
    private int layout;
    private List<Guests> userList;
    private String ergebnis;
    String uzibo1;
    String uzibo2;
    String encryptedData;
    String name;
    String mail;
    String Control;

    static {
        System.loadLibrary("uzibo");
    }

    public native String getNativeUzibo1();
    public native String getNativeUzibo2();


    public CustomArrayAdapter(Context context, int layout, List<Guests> userList){
        super(context, layout, userList);
        this.context   = context;
        this.layout    = layout;
        this.userList  = userList;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent){
        Guests user = userList.get(position);
        if (convertView == null)
            convertView = LayoutInflater.from(context).inflate(layout, null);

        uzibo1 = new String(Base64.decode(getNativeUzibo1(),Base64.DEFAULT));
        uzibo2 = new String(Base64.decode(getNativeUzibo2(),Base64.DEFAULT));

        encryptedData                  =  user.getEncryptedData();
        String encryptionDecryptionKey =  uzibo1;
        String iv                      =  uzibo2;

        if(encryptedData.startsWith("AMAR")){
            name = "Luca® Code";
            mail = "Luca® Code";
        }else {

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

            //************************************************************************************************
            //                      get name and e-mail as seperated values
            //************************************************************************************************

            // contactdetails are formatted partially only, we know (or better hope)
            // that e-mail is the last element and we no seperator is " "
            // therefore we split contactdetails with seperator
            // and takte the last element for email and the rest for name

            // seperate
            String[] splitErgebnis = ergebnis.split(" ");
            // get last item for e-mail
            int numberOfElements = splitErgebnis.length;
            int numberOfLastItem = numberOfElements - 1;
            mail = splitErgebnis[numberOfLastItem];
            // get rest for name
            name = splitErgebnis[0];
            for (int i = 1; i < numberOfLastItem; i++) {
                name = splitErgebnis[i] + " " + name;
            }
        }
        //************************************************************************************************
        //                      display values in List-element
        //************************************************************************************************

        TextView TextEncryptedData = convertView.findViewById(R.id.encryptedName);
        //String splitergebnis[] = ergebnis.split(":");
        TextEncryptedData.setText(name);


        TextView Text_mail  = convertView.findViewById(R.id.mail);
        Text_mail.setText(mail);

        String Table        =  user.getTable_number();

        TextView Text_table  = convertView.findViewById(R.id.table_number);
        Text_table.setText(Table);

        String Flag        =  user.getFlag();

        TextView Text_flag  = convertView.findViewById(R.id.flag);
        Text_flag.setText(Flag);

        if(encryptedData.startsWith("AMAR")){
            Control = encryptedData;
        }else Control        =  user.getControl();

        TextView TextArrival_control  = convertView.findViewById(R.id.control);
        TextArrival_control.setText(Control);

        String Arrival_date        =  user.getArrival_date();

        TextView TextArrival_date  = convertView.findViewById(R.id.arrival_date);
        TextArrival_date.setText(Arrival_date);

        String Arrival_time        =  user.getArrival_time();

        TextView TextArrival_time  = convertView.findViewById(R.id.arrival_time);
        TextArrival_time.setText(Arrival_time);

        String Leave_time        =  user.getLeave_time();

        TextView TextLeave_time  = convertView.findViewById(R.id.leave_time);
        TextLeave_time.setText(Leave_time);


        return convertView;
    }



}
