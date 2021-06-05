package com.wirtshauskartn.testcardscanner;

import android.content.Context;

import androidx.room.Database;
import androidx.room.Room;
import androidx.room.RoomDatabase;

@Database(entities = {Guests.class}, version = 1, exportSchema = false)
public abstract class GuestDatabase extends RoomDatabase {
    private static String DATABASE = "KartnBastlernnDB";
    private static com.wirtshauskartn.testcardscanner.GuestDatabase instance;
    static com.wirtshauskartn.testcardscanner.GuestDatabase getInstance(Context context){
        if(instance == null){
            instance = Room.databaseBuilder(
                    context.getApplicationContext(),
                    com.wirtshauskartn.testcardscanner.GuestDatabase.class,
                    DATABASE)
                    .allowMainThreadQueries()
                    .build();
        }
        return instance;
    }
    public abstract GuestDAO getGuestDao();
}
