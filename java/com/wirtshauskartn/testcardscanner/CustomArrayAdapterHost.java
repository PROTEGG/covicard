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

public class CustomArrayAdapterHost extends ArrayAdapter<Guests> {
    private Context context;
    private int layout;
    private List<Guests> userList;
    private String ergebnis;

    String uzibo1;
    String uzibo2;
    String encryptedData;

    static {
        System.loadLibrary("uzibo");
    }

    public native String getNativeUzibo1();
    public native String getNativeUzibo2();

    public CustomArrayAdapterHost(Context context, int layout, List<Guests> userList){
        super(context, layout, userList);
        this.context = context;
        this.layout = layout;
        this.userList = userList;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent){
        Guests user = userList.get(position);
        if (convertView == null)
            convertView = LayoutInflater.from(context).inflate(layout, null);

        encryptedData="";
        ergebnis="";
        uzibo1 = new String(Base64.decode(getNativeUzibo1(),Base64.DEFAULT));
        uzibo2 = new String(Base64.decode(getNativeUzibo2(),Base64.DEFAULT));

        encryptedData                  =  user.getEncryptedData();
        String encryptionDecryptionKey =  uzibo1;
        String iv                      =  uzibo2;





        if(encryptedData.startsWith("AMAR")){
            ergebnis = "Luca® Code";
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


            String[] splitErgebnis = ergebnis.split(" ");
            ergebnis = splitErgebnis[0];
        }

        TextView TextEncryptedData = convertView.findViewById(R.id.encryptedName);
        TextEncryptedData.setText(ergebnis);


        String Code                = encryptedData;
        TextView TextCode          = convertView.findViewById(R.id.encrypteddata);
        TextCode.setText(Code);

        String Control             =  user.getControl();

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

        String Table_number        =  user.getTable_number();

        TextView TextTable_number  = convertView.findViewById(R.id.table_number);
        TextTable_number.setText(Table_number);

        return convertView;
    }



}
