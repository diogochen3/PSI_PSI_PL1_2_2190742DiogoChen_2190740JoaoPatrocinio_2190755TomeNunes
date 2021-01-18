package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.ContentValues;
import android.content.Context;
import android.os.PowerManager;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import javax.crypto.Mac;

import amsi.dei.estg.ipleiria.healthschedule.listeners.EspecialidadeListener;
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
    private HospitalLoginListener hospitalLoginListener;
    private final HospitalBDHelper hospitalDB;

    /************************ variaveis marcacao ******************************************/
    private static final  String  mUrlAPIMarcacao =  "http://192.168.1.20/hospital/frontend/web/index.php/api/marcacao";
    private ArrayList<Marcacao> marcacoes;
    private MarcacoesListener MarcacoesListener;
    private static final int ADICIONAR_MARCACAO_BD = 1;
    private static final int EDITAR_MARCACAO_BD = 2;
    private static final int REMOVER_MARCACAO_BD = 3;

    /************************ variaveis Profile ******************************************/
    private static final  String  mUrlAPIProfile =  "http://192.168.1.20/hospital/frontend/web/index.php/api/profile";
    private ArrayList<Profile> profiles;
    private ProfileListener profileListener;

    /************************ variaveis Profile ******************************************/
    private static final  String  mUrlAPIEspecialidade =  "http://192.168.1.20/hospital/frontend/web/index.php/api/especialidade";
    private ArrayList<Especialidade> especialidades;
    private EspecialidadeListener especialidadeListener;



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
        marcacoes= new ArrayList<>();
        especialidades= new ArrayList<>();

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

    public Profile getProfileName(String nome){
        for (Profile l: profiles)
            if (l.getFirst_name().equals(nome))
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
                    Toast.makeText(context, "Funcionou", Toast.LENGTH_SHORT).show();
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


    /*******  metodo aceder base dados profile localmente     *////////

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
           Toast.makeText(context, "False", Toast.LENGTH_SHORT).show();
       }else {

           //JsonRequest req;
          // req = new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>()
           JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>() {

               @Override
               public void onResponse(JSONArray response) {
                   Toast.makeText(context, "POutasE VINHO VERDE", Toast.LENGTH_SHORT).show();
                   marcacoes = HospitalJsonParser.parserJsonMarcacoes(response);
                   adicionarMarcacoesBD(marcacoes);


                   if(MarcacoesListener != null){
                       MarcacoesListener.onRefreshListaMarcacoes(hospitalDB.getAllMarcacoesBD());
                   }

               }
           }, new Response.ErrorListener() {
               @Override
               public void onErrorResponse(VolleyError error) {
                   Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
               }
           });
           //Toast.makeText(context, "Helo", Toast.LENGTH_SHORT).show();
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

    public void adicionarMarcacaoAPI(final Marcacao marcacao, final Context context){

        StringRequest req =new StringRequest(Request.Method.POST,
                mUrlAPIMarcacao,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Marcacao l = HospitalJsonParser.parserJsonMarcacao(response);
                        onUpdateLitaMarcacaoBD(l,ADICIONAR_MARCACAO_BD);

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
                params.put("date", marcacao.getDate());
                params.put("tempo", marcacao.getTempo());
                params.put("Aceitar", marcacao.getAceitar()+"");
                params.put("id_especialidade", marcacao.getId_especialidade() + "");
                params.put("id_Utente", marcacao.getId_Medico()+"");
                params.put("id_Medico", marcacao.getId_Utente()+"");
                return params;
            }
        };


        volleyQueue.add(req);
    }
    public void editarMarcacaoAPI(final Marcacao marcacao, final Context context){

        StringRequest req =new StringRequest(Request.Method.POST,
                mUrlAPIMarcacao,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Marcacao l = HospitalJsonParser.parserJsonMarcacao(response);
                        onUpdateLitaMarcacaoBD(l,EDITAR_MARCACAO_BD);

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
                params.put("date", marcacao.getDate());
                params.put("tempo", marcacao.getTempo());
                params.put("Aceitar", marcacao.getAceitar()+"");
                params.put("id_especialidade", marcacao.getId_especialidade() + "");
                params.put("id_Utente", marcacao.getId_Medico()+"");
                params.put("id_Medico", marcacao.getId_Utente()+"");
                return params;
            }
        };


        volleyQueue.add(req);
    }

    public  void onUpdateLitaMarcacaoBD(Marcacao marcacao, int operacao)
    {
        switch (operacao){
            case ADICIONAR_MARCACAO_BD:
                adicionarMarcacaoBD(marcacao);
                break;
            case EDITAR_MARCACAO_BD:
                editarMarcacaoBD(marcacao);
                break;
            case REMOVER_MARCACAO_BD:
                removerMarcacaoBD(marcacao.getId());
                break;
        }
    }

    public Marcacao getMarcacao(int id){
        for (Marcacao l: marcacoes)
            if (l.getId() == id)
                return l;
        return null;
    }

    public ArrayList<Marcacao> getallMarcacaoBD() {
        marcacoes = hospitalDB.getAllMarcacoesBD();
        return marcacoes;
    }

    public void adicionarMarcacoesBD(ArrayList<Marcacao> marcacoes){
            hospitalDB.removerAllMarcacoesBD();
            for(Marcacao l: marcacoes){
                adicionarMarcacaoBD(l);
        }
    }

    public void adicionarMarcacaoBD(Marcacao marcacao){
        hospitalDB.adicionarMarcacaoBD(marcacao);
    }

    private void editarMarcacaoBD(Marcacao marcacao) {
        Marcacao marcacaoAux = getMarcacao(marcacao.getId());
        if (marcacaoAux!=null)
        {
            hospitalDB.editarMarcacaoBD(marcacaoAux);
         /*   if (livrosBD.editarLivroBD(livroAux)){
                livroAux.setTitulo(livro.getTitulo());
                livroAux.setAutor(livro.getAutor());
                livroAux.setCapa(livro.getCapa());
                livro.setSerie(livro.getSerie());
                livro.setAno(livro.getAno());
            }*/
        }


    }

    private void removerMarcacaoBD(int id) {
        Marcacao livro= getMarcacao(id);
        if(livro!= null){
            //if (livrosBD.removerLivroBD(id))
            hospitalDB.removerLivroBD(id);
        }

    }


    public void setMarcacaoListener(MarcacoesListener marcacaoesListener) {
        this.MarcacoesListener = marcacaoesListener;
   }

   /**************************** Especialidade **************************************/
   public String getEspecialidadeNome(int id){
       for (Especialidade l: especialidades)
           if (l.getId() == id)
               return l.getName();
       return null;
   }
    public Especialidade getEspecialidade(String nome){
        for (Especialidade l: especialidades)
            if (l.getName().equals(nome))
                return l;

            return null;
    }

   public void getAllEspecialidadeAPI(final Context context){

       if (!HospitalJsonParser.isConnectionInternet(context)) {
           Toast.makeText(context, "False", Toast.LENGTH_SHORT).show();
       }else {

           //JsonRequest req;
           // req = new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>()
           JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIEspecialidade, null, new Response.Listener<JSONArray>() {

               @Override
               public void onResponse(JSONArray response) {
                   Toast.makeText(context, "POutasE VINHO VERDE", Toast.LENGTH_SHORT).show();
                   especialidades = HospitalJsonParser.parserJsonEspecialidades(response);
                   adicionarEspecialidadesBD(especialidades);


                   if(especialidadeListener != null){
                       especialidadeListener.onRefreshListaEspecialidade(hospitalDB.getAllEspecialidadeBD());
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

    public void adicionarEspecialidadesBD(ArrayList<Especialidade> especialidades){
        hospitalDB.removerAllEspecialidadesBD();
        for(Especialidade l: especialidades){
            adicionarEspecialidadeBD(l);
        }
    }

    public void adicionarEspecialidadeBD(Especialidade especialidade){
        hospitalDB.adicionarEspecialidadeBD(especialidade);
    }

}
