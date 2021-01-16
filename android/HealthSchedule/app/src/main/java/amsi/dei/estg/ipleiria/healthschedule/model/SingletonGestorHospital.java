package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.Context;
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

import amsi.dei.estg.ipleiria.healthschedule.listeners.HospitalLoginListener;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;

public class SingletonGestorHospital {
    private ArrayList<amsi.dei.estg.ipleiria.healthschedule.model.Marcacao> Marcacao;
    private static RequestQueue volleyQueue;

    private static SingletonGestorHospital instance = null;
    private static final  String  mUrlAPILogin =  "http://front.test/index.php/api/default";
        private static final  String  mUrlAPIMarcacao =  "http://front.test/index.php/api/marcacao";
    private HospitalLoginListener hospitalLoginListener;
    private HospitalBDHelper MarcacaoDB =null;
    private amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener MarcacoesListener;
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
           JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>() {
               @Override
               public void onResponse(JSONArray response) {
                   Marcacao = HospitalJsonParser.parserJsonMarcacao(response);
                   adicionarMarcacoesBD(Marcacao);


                   if(MarcacoesListener != null){
                       MarcacoesListener.onRefreshListaLivros(MarcacaoDB.getAllMarcacoesBD());
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
    public void adicionarMarcacoesBD(ArrayList<amsi.dei.estg.ipleiria.healthschedule.model.Marcacao> marcacoes){
        MarcacaoDB.removerAllMarcacoesBD();
            for(amsi.dei.estg.ipleiria.healthschedule.model.Marcacao l: marcacoes){
                adicionarMarcacaoBD(l);
        }

    }
    public void adicionarMarcacaoBD(amsi.dei.estg.ipleiria.healthschedule.model.Marcacao marcacao){
        MarcacaoDB.adicionarMarcacaoBD(marcacao);


    }
}
