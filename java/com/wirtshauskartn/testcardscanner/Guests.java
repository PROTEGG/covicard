package com.wirtshauskartn.testcardscanner;
import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

// Zeile der SQL-Datenbank definieren

@Entity(tableName = "Users")
public class Guests { @PrimaryKey(autoGenerate = true)
private int id;

    @ColumnInfo(name = "encryptedData")
    private String encryptedData;

    @ColumnInfo(name = "control")
    private String control;

    @ColumnInfo(name = "flag")
    private String flag;

    @ColumnInfo(name = "arrival_date")
    private String arrival_date;

    @ColumnInfo(name = "arrival_time")
    private String arrival_time;

    @ColumnInfo(name = "leave_time")
    private String leave_time;

    @ColumnInfo(name = "table_number")
    private String table_number;

// Constructor = Repräsentiert eine Zeile der Datenbank

    public Guests(String encryptedData, String control, String flag, String arrival_date, String arrival_time, String leave_time, String table_number) {
        this.encryptedData  = encryptedData;
        this.control        = control;
        this.flag           = flag;
        this.arrival_date   = arrival_date;
        this.arrival_time   = arrival_time;
        this.leave_time     = leave_time;
        this.table_number   = table_number;

    }

    public int    getId() { return id; }
    public void   setId(int id) { this.id = id; }

    public String getEncryptedData() {
        return encryptedData;
    }
    public void   setEncryptedData(String getEncryptedData) {
        this.encryptedData = encryptedData;
    }

    public String getControl() {
        return control;
    }

    public void setControl(String control) {
        this.control = control;
    }

    public String getFlag() {
        return flag;
    }

    public void setFlag(String flag) {
        this.flag = flag;
    }

    public String getArrival_date() {
        return arrival_date;
    }
    public void   setArrival_date(String arrival_date) {
        this.arrival_date = arrival_date;
    }

    public String getArrival_time() {
        return arrival_time;
    }
    public void   setArrival_time(String fullName) {
        this.arrival_time = fullName;
    }

    public String getLeave_time() {
        return leave_time;
    }
    public void   setLeave_time(String fullName) {
        this.leave_time = fullName;
    }

    public String getTable_number() {
        return table_number;
    }
    public void   setTable_number(String fullName) {
        this.table_number = fullName;
    }


    @Override
    public String toString() {
        return "User{" +
                "encryptedData='"  + encryptedData  + '\'' +
                "control='"        + control        + '\'' +
                "flag='"           + flag           + '\'' +
                "arrival_date='"   + arrival_date   + '\'' +
                "arrival_time='"   + arrival_time   + '\'' +
                "leave_time='"     + leave_time     + '\'' +
                "table_number='"   + table_number   +

                '}';
    }


}

