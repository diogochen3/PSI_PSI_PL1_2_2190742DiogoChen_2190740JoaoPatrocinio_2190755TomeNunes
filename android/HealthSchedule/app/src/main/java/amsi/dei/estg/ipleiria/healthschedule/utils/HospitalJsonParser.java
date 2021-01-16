package amsi.dei.estg.ipleiria.healthschedule.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;


import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;

public class HospitalJsonParser {

    /// Profile
    public static ArrayList<Profile> parserJsonProfiles(JSONArray response) {

        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");

        ArrayList<Profile> profiles = new ArrayList<>();
        if (response != null) {
            for (int i = 0; i < response.length(); i++) {
                try {
                    JSONObject profile = (JSONObject) response.get(i);
                    int id = profile.getInt("id");
                    String pNome = profile.getString("First_name");
                    String apelido = profile.getString("Last_name");
                    String email = profile.getString("Email");
                    int telefone = profile.getInt("Phone_number");
                    int nif = profile.getInt("NIF");
                    String endereco = profile.getString("Address");
                    String dNascimento = profile.getString("Birth_date");
                    String genero = profile.getString("gender");
                    String codPostal = profile.getString("postal_code");

                    Date date = formatter.parse(dNascimento);

                    Profile p = new Profile(id, pNome, apelido, email, telefone, nif, endereco, date, genero, codPostal);
                    profiles.add(p);
                } catch (JSONException | ParseException e) {
                    e.printStackTrace();
                }
            }
        }
        return profiles;
    }


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
