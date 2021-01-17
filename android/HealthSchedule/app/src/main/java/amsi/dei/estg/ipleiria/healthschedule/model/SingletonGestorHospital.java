package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.Context;
import android.os.PowerManager;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

import java.util.ArrayList;

import javax.crypto.Mac;

import amsi.dei.estg.ipleiria.healthschedule.listeners.HospitalLoginListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.ProfileListener;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import amsi.dei.estg.ipleiria.healthschedule.views.AgendaFragment;

public class SingletonGestorHospital {
    private ArrayList<amsi.dei.estg.ipleiria.healthschedule.model.Marcacao> Marcacao;
    private static RequestQueue volleyQueue;

    private static SingletonGestorHospital instance = null;
    private static final  String  mUrlAPILogin =  "http://front.test/index.php/api/default";
        private static final  String  mUrlAPIMarcacao =  "http://192.168.1.119/index.php/api/marcacao";
    private HospitalLoginListener hospitalLoginListener;
    private final HospitalBDHelper hospitalDB ;

    private MarcacoesListener MarcacoesListener;

    /************************ variaveis Profile ******************************************/
    private static final  String  mUrlAPIProfile =  "http://192.168.1.20/hospital/frontend/web/index.php/api/profile";
    private ArrayList<Profile> profiles;
    private ProfileListener profileListener;


    public static synchronized SingletonGestorHospital getInstance(Context context) {
        if (instance == null)
        {
            instance = new SingletonGestorHospital(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    private SingletonGestorHospital(Context context) {
        profiles= new ArrayList<>();
        hospitalDB =new HospitalBDHelper(context);
    }

    /******************************************* Setter ******************************/

    public void setHospitalLoginListener(HospitalLoginListener hospitalLoginListener) {
        this.hospitalLoginListener = hospitalLoginListener;
    }

    /*********************************** Profile ******************************************/

    public Profile getProfile(int id){
        for (Profile l: profiles)
            if (l.getId() == id)
                return l;
        return null;
    }

    public void getAllProfileAPI(final Context context){
        if (!HospitalJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "False", Toast.LENGTH_SHORT).show();
        }else {
            JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIProfile, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    profiles = HospitalJsonParser.parserJsonProfiles(response);
                    adicionarProfilesBD(profiles);

                    if(profileListener != null){
                        profileListener.onRefreshListaProfiles(hospitalDB.getAllProfilesBD());
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    /*******  metodo aceder base dados localmente     *////////

    public void adicionarProfilesBD(ArrayList<Profile> profiles){
        hospitalDB.removerAllProfilesBD();
        for(Profile l: profiles){
            adicionarProfileBD(l);
        }
    }

    public void adicionarProfileBD(Profile profile){
        hospitalDB.adicionarProfileBD(profile);
    }

   /* public void loginAPI(final String email, final String pass, final Context applicationContext) {

        StringRequest req =new StringRequest(Request.Method.POST,
                    mUrlAPILogin, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    String token = HospitalJsonParser.parserJsonLogin(response);

                    if(hospitalLoginListener != null)
                    {
                        hospitalLoginListener.onValidateLogin(token,email);
                    }
                    //TODO: informar a vista -> listener
                }
            },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(applicationContext, error.getMessage(), Toast.LENGTH_SHORT).show();
                        }

                    }) {
                protected Map<String, String> params() {
                    Map<String, String> params = new HashMap<>();
                    params.put("email", email);
                    params.put("password", pass);

                    return params;
                }
            };

            volleyQueue.add(req);

    }*/
   public void getAllMarcacaoAPI(final Context context){

       if (!HospitalJsonParser.isConnectionInternet(context)) {


       }else {

           //JsonRequest req;
          // req = new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>()
           JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>() {

               @Override
               public void onResponse(JSONArray response) {
                   Toast.makeText(context, "POutasE VINHO VERDE", Toast.LENGTH_SHORT).show();
                   Marcacao = HospitalJsonParser.parserJsonMarcacao(response);
                   adicionarMarcacoesBD(Marcacao);


                   if(MarcacoesListener != null){

                       MarcacoesListener.onRefreshListaLivros(hospitalDB.getAllMarcacoesBD());
                   }

               }
           }, new Response.ErrorListener() {
               @Override
               public void onErrorResponse(VolleyError error) {
                   Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
               }
           });
           Toast.makeText(context, "Helo", Toast.LENGTH_SHORT).show();
           /*req =new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>() {


               @Override

               public void onResponse(JSONArray response) {

                   Marcacao = HospitalJsonParser.parserJsonMarcacao(response);
                   adicionarMarcacoesBD(Marcacao);


                   if(MarcacoesListener != null){

                       MarcacoesListener.onRefreshListaLivros(hospitalDB.getAllMarcacoesBD());
                   }
               }
           }, new Response.ErrorListener() {
               @Override
               public void onErrorResponse(VolleyError error) {
                   Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
               }
           });*/
           volleyQueue.add(req);

       }
   }
    public void adicionarMarcacoesBD(ArrayList<Marcacao> marcacoes){
            hospitalDB.removerAllMarcacoesBD();
            for(Marcacao l: marcacoes){
                adicionarMarcacaoBD(l);
        }

    }
    public void adicionarMarcacaoBD(amsi.dei.estg.ipleiria.healthschedule.model.Marcacao marcacao){
        hospitalDB.adicionarMarcacaoBD(marcacao);
    }

    public void setMarcacaoListener(MarcacoesListener marcacaoesListener) {
        this.MarcacoesListener = marcacaoesListener;

   }
}
