package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.Context;

import java.util.ArrayList;

public class SingletonGestorHospital {
    private static SingletonGestorHospital instance = null;


    public static synchronized SingletonGestorHospital getInstance(Context context) {
        if (instance == null)
            instance = new SingletonGestorHospital(context);
        return instance;
    }

    private SingletonGestorHospital(Context context) {

    }
}
