package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import amsi.dei.estg.ipleiria.healthschedule.listeners.HospitalLoginListener;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;

public class SingletonGestorHospital {
    private static RequestQueue volleyQueue;
    private static SingletonGestorHospital instance = null;
    private static final String mUrlAPILogin = "";
    private HospitalLoginListener hospitalLoginListener;

    public static synchronized SingletonGestorHospital getInstance(Context context) {
        if (instance == null)
        {
            instance = new SingletonGestorHospital(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    private SingletonGestorHospital(Context context) {

    }

    /******************************************* Setter ******************************/

    public void setHospitalLoginListener(HospitalLoginListener hospitalLoginListener) {
        this.hospitalLoginListener = hospitalLoginListener;
    }


    public void loginAPI(String email, String pass, Context applicationContext) {

        StringRequest req =new StringRequest(Request.Method.POST,
                    mUrlAPILogin, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    String token = HospitalJsonParser.parserJsonLogin(response);

                    if(HospitalLoginListener != null)
                    {
                        HospitalLoginListener.onValidateLogin(token,email);
                    }
                    //TODO: informar a vista -> listener
                }
            },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                        }

                    }) {
                protected Map<String, String> params() {
                    Map<String, String> params = new HashMap<>();
                    params.put("email", email);
                    params.put("password", pass);
                    params.put("token", TOKEN);
                    return params;
                }
            };

            volleyQueue.add(req);

    }
}
