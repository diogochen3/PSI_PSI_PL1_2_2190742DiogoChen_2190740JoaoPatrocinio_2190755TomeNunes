package com.example.testes_android;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.NotificationCompat;

import android.app.NotificationManager;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {

    Button button;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        button=findViewById(R.id.btnotificar);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                NotificationCompat.Builder notification=(NotificationCompat.Builder)
                        new NotificationCompat.Builder(getApplicationContext())
                        .setContentTitle("Alerta de consulta!!")
                        .setContentText("Consulta dia 23/12/2020, 13h");

                NotificationManager notificationManager=(NotificationManager)
                        getSystemService(NOTIFICATION_SERVICE);
                NotificationManager.notification(id: 0 ,notification.build());
            }
        });
    }
}