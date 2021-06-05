package com.wirtshauskartn.testcardscanner;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.Query;

import java.util.List;

@Dao
interface GuestDAO {
    @Insert
    long insertGuestData(Guests guests);

    @Query("SELECT * FROM Users WHERE arrival_date = :controlDate OR  (arrival_date = date(:controlDate, '+1 day') AND arrival_time < '05:00:00')")
    List<Guests> guestsSelected(String controlDate);

    @Query("SELECT * FROM Users")
    List<Guests> getHoleTable();

    @Query("UPDATE Users Set leave_time = :leave_time WHERE encryptedData = :encryptedData AND leave_time = '00:00:00' AND arrival_time < time('now', '-2 hour')")
    int closeGuestOpen(String leave_time, String encryptedData);

    @Query("UPDATE Users Set leave_time = :leave_time WHERE leave_time = '00:00:00'")
    int finishAllTables(String leave_time);

    @Query("UPDATE Users Set leave_time = :controllResult WHERE encryptedData = :encryptedData AND arrival_time = :arrival_time")
    int updateFlag(String controllResult, String arrival_time, String encryptedData);

    @Query("UPDATE Users Set leave_time = :leave_time WHERE table_number = :table_number AND leave_time = '00:00:00'")
    int updateUser(String leave_time, String table_number);

    @Query("DELETE FROM Users WHERE arrival_date <= date('now', '-30 day')")
    int DeleteUser();

    @Query("DELETE FROM Users WHERE encryptedData !=''")
    int DeleteAll();

    @Query("SELECT COUNT(*) FROM Users")
    int numberOfRows();

    @Query("SELECT COUNT(*) FROM Users WHERE arrival_date = :controlDate OR  (arrival_date = date(:controlDate, '+1 day') AND arrival_time < '05:00:00')")
    int numberOfRowsControlDates(String controlDate);
}