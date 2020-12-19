package amsi.dei.estg.ipleiria.healthschedule.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import org.json.JSONException;
import org.json.JSONObject;

public class HospitalJsonParser {

    public static String parserJsonLogin(String response){
        String token = null;

        try {
            JSONObject login = new JSONObject(response);
            if(login.getBoolean("success")){
                token= login.getString("token");
            }

        } catch(JSONException e) {
            e.printStackTrace();
        }

        return token;
    }

    public static boolean isConnectionInternet(Context context)
    {
        ConnectivityManager cm =(ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo ni = cm.getActiveNetworkInfo();

        return ni!=null && ni.isConnected();
    }
}
