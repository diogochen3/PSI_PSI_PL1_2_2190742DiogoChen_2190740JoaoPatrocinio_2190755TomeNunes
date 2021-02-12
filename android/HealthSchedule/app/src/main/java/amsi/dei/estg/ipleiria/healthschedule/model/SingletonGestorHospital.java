package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.ContentValues;
import android.content.Context;
import android.graphics.Bitmap;
import android.os.PowerManager;
import android.os.ProxyFileDescriptorCallback;
import android.provider.SyncStateContract;
import android.util.Base64;
import android.widget.ArrayAdapter;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.lang.reflect.Array;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import javax.crypto.Mac;

import amsi.dei.estg.ipleiria.healthschedule.listeners.DiagnosticoListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.EspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.HospitalLoginListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MedicoEspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.ProfileListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.ReceitasListener;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import amsi.dei.estg.ipleiria.healthschedule.views.AgendaFragment;
import amsi.dei.estg.ipleiria.healthschedule.views.MarcacaoActivity;

public class SingletonGestorHospital {

    private static RequestQueue volleyQueue;

    private static SingletonGestorHospital instance = null;
    private static final  String  mUrlAPILogin =  "http://192.168.1.119/index.php/api/user/login";
    private HospitalLoginListener hospitalLoginListener;
    private final HospitalBDHelper hospitalDB;

    /************************ variaveis marcacao ******************************************/


    private static final  String  mUrlAPIMarcacao =  "http://192.168.1.119/index.php/api/marcacao";
    private ArrayList<Marcacao> marcacoes;
    private MarcacoesListener MarcacoesListener;
    private static final int ADICIONAR_MARCACAO_BD = 1;
    private static final int EDITAR_MARCACAO_BD = 2;
    private static final int REMOVER_MARCACAO_BD = 3;

    /************************ variaveis Profile ******************************************/

    private static final  String  mUrlAPIProfile =  "http://192.168.1.119/index.php/api/profile";
    private ArrayList<Profile> profiles;
    private ProfileListener profileListener;

    /************************ variaveis Especialidade ******************************************/

    private static final  String  mUrlAPIEspecialidade =  "http://192.168.1.119/index.php/api/especialidade";
    private ArrayList<Especialidade> especialidades;
    private ArrayList<String> especialidadesNome;
    private EspecialidadeListener especialidadeListener;

    /************************ variaveis Diagnostico ******************************************/
    private static final  String  mUrlAPIDiagnostico =  "http://192.168.1.119/index.php/api/diagnostico";
    private ArrayList<Diagnostico> diagnosticos;
    private DiagnosticoListener DiagnosticosListener;
    /************************ variaveis Receitas ******************************************/
    private static final  String  mUrlAPIReceitas =  "http://192.168.1.119/index.php/api/receitas";
    private ArrayList<Receita> receitas;
    private ReceitasListener ReceitasListener;

    /************************ variaveis MedicoEspecialidade ******************************************/
    private static final  String  mUrlAPIMedicoEspecialidade =  "http://192.168.1.119/index.php/api/medicoespecialidade";
    private ArrayList<MedicoEspecialidade> medicoEspecialidades;
    private MedicoEspecialidadeListener medicoEspecialidadeListener;


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
        especialidadesNome= new ArrayList<>();
        medicoEspecialidades= new ArrayList<>();
        hospitalDB =new HospitalBDHelper(context);
    }

    /******************************************* Setter ******************************/

    public void setHospitalLoginListener(HospitalLoginListener hospitalLoginListener) {
        this.hospitalLoginListener = hospitalLoginListener;
    }

    public void setEspecialidadeListener(EspecialidadeListener especialidadeListener) {
        this.especialidadeListener = especialidadeListener;
    }

    public void setMarcacaoListener(MarcacoesListener marcacaoesListener) {
        this.MarcacoesListener = marcacaoesListener;
    }
    public void setDiagnosticosListener(DiagnosticoListener diagnosticosListener) {
        this.DiagnosticosListener = diagnosticosListener;
    }
    public void setReceitasListener(ReceitasListener receitasListener) {
        this.ReceitasListener = receitasListener;
    }

    public void setProfileListener(ProfileListener profileListener) {
        this.profileListener = profileListener;
    }

    public void setMedicoEspecialidadeListener(MedicoEspecialidadeListener medicoEspecialidadeListener) {
        this.medicoEspecialidadeListener = medicoEspecialidadeListener;
    }

    /*********************************** Profile ******************************************/
    public Profile getProfile(int id){
        for (Profile l: profiles)
            if (l.getId() == id)
                return l;
        return null;
    }
    public Profile getProfileBD(int id){
        ArrayList<Profile> profilesBD = getallProfileBD();
        for (Profile l: profilesBD)
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

    public void editarProfileAPI(final Profile perfil, final Context context, final String image) {
        StringRequest req =new StringRequest(Request.Method.PUT,
                mUrlAPIProfile+"/profilenew/"+perfil.getId(),
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Profile p = HospitalJsonParser.parserJsonProfile(response);

                        editarProfileBD(p);
                        if(profileListener != null){
                            profileListener.onRefreshdetalhesProfiles();
                        }
                    }
                },
                new Response.ErrorListener() {

                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                    }

                }) {

            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                SimpleDateFormat dateFormatter = new SimpleDateFormat("yyyy-MM-dd");
                String date = dateFormatter.format(perfil.getBirth_date());

                params.put("First_name", perfil.getFirst_name());
                params.put("Last_name", perfil.getLast_name());
                params.put("Email", perfil.getEmail());
                params.put("Phone_number", perfil.getPhone_number()+"");
                params.put("NIF", perfil.getNIF()+"");
                params.put("Address", perfil.getAddress());
                params.put("Birth_date", date);
                params.put("gender", perfil.getGender());
                params.put("postal_code", perfil.getPostal_code());
                params.put("image", image);
                return params;
            }
        };


        volleyQueue.add(req);
    }


    private void editarProfileBD(Profile profile) {
        Profile profileAux = getProfile(profile.getId());
        if (profileAux!=null)
        {
            hospitalDB.editarProfileBD(profileAux);
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

    public ArrayList<Profile> getMedicos(long id) {

        ArrayList<Profile> profile = new ArrayList<>();

        for (MedicoEspecialidade me: medicoEspecialidades)
        {
            for (Profile p: profiles)
            {
                if ( (int)id == me.getId_Especialidade() && me.getId_Medico() == p.getId())  {
                    profile.add(p);
                }
            }
        }
        return profile;
    }
    public ArrayList<Profile> getMedicosEspecialidade() {

        ArrayList<Profile> profile = new ArrayList<>();

        for (MedicoEspecialidade me: medicoEspecialidades)
        {
            for (Profile p: profiles)
            {
                if (me.getId_Medico() == p.getId())  {
                    profile.add(p);
                }
            }
        }
        return profile;

    }




    public ArrayList<Profile> getallProfileBD() {
        profiles = hospitalDB.getAllProfilesBD();
        return profiles;
    }

    /******************************************           Login   **************************************************/
    public void loginAPI(final String email, final String pass, final Context applicationContext) {
        StringRequest req =new StringRequest(Request.Method.POST, mUrlAPILogin, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                int id = HospitalJsonParser.parserJsonLogin(response);

                if(hospitalLoginListener != null)
                {
                    hospitalLoginListener.onValidateLogin(email,id);
                }
                //TODO: informar a vista -> listener
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(applicationContext, "Login invalido", Toast.LENGTH_SHORT).show();
                    }
                })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("Email", email);
                params.put("Password", pass);
                return params;
            }

            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {

                Map<String,String> headers = new HashMap<>();
                // add headers <key,value>
                String credentials = email+":"+pass;
                String auth = "Basic "
                        + Base64.encodeToString(credentials.getBytes(),
                        Base64.NO_WRAP);

                headers.put("Authorization", auth);
                return headers;

            }
        };

        volleyQueue.add(req);

    }

    /************************************* Marcacao ****************************************************************/
    public ArrayList<Marcacao> getMarcacoes(int id, ArrayList<Marcacao> marcacao)
    {
        ArrayList<Marcacao> auxmarcacao = new ArrayList<>();
        for (Marcacao m: marcacao) {
            if (id == m.getId_Utente())
            {
                auxmarcacao.add(m);
            }
        }
        return auxmarcacao;
    }


    public void getAllMarcacaoAPI(final Context context){

        if (!HospitalJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "False", Toast.LENGTH_SHORT).show();
        }else {
            JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>() {

                @Override
                public void onResponse(JSONArray response) {
                    marcacoes = HospitalJsonParser.parserJsonMarcacoes(response);
                   /*ArrayList<Marcacao> auxmarcacao;
                   auxmarcacao = HospitalJsonParser.parserJsonMarcacoes(response);

                   for (Marcacao m: auxmarcacao) {
                       if (id == m.getId_Utente())
                       {
                           marcacoes.add(m);
                       }
                   }*/

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
            volleyQueue.add(req);

        }
    }


    public void adicionarMarcacaoAPI(final Marcacao marcacao, final Context context){

        StringRequest req =new StringRequest(Request.Method.POST,
                mUrlAPIMarcacao+"/marcar",
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Marcacao l = HospitalJsonParser.parserJsonMarcacao(response);
                        onUpdateLitaMarcacaoBD(l,ADICIONAR_MARCACAO_BD);

                        if(MarcacoesListener != null){
                            MarcacoesListener.onRefreshdetalhesMarcacoes();
                        }
                        //TODO: informar a vista -> listener
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                })

        {

            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
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

        StringRequest req =new StringRequest(Request.Method.PUT,
                mUrlAPIMarcacao+"/marcacaonew/"+marcacao.getId(),
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Marcacao l = HospitalJsonParser.parserJsonMarcacao(response);
                        onUpdateLitaMarcacaoBD(l,EDITAR_MARCACAO_BD);
                        if(MarcacoesListener != null){
                            MarcacoesListener.onRefreshdetalhesMarcacoes();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                    }

                }) {

            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
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

    public void removerMarcacaoAPI (final  Marcacao marcacao, final  Context context){
        StringRequest req =new StringRequest(Request.Method.DELETE, mUrlAPIMarcacao+ "/marcardel/"+marcacao.getId(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Marcacao m = HospitalJsonParser.parserJsonMarcacao(response);
                onUpdateLitaMarcacaoBD(m,REMOVER_MARCACAO_BD);

                if(MarcacoesListener != null){
                    MarcacoesListener.onRefreshdetalhesMarcacoes();
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
    public ArrayList<Diagnostico> getallDiagnosticoBD() {
        diagnosticos = hospitalDB.getAllDiagnosticosBD();
        return diagnosticos;
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
        }

    }

    private void removerMarcacaoBD(int id) {
        Marcacao marcacao= getMarcacao(id);
        if(marcacao!= null){
            hospitalDB.removerMarcacaoBD(id);
        }
    }



    /************************************************    Diagonostico   *******************************************************/
    public void getAllDiagnosticoAPI(final Context context){

        if (!HospitalJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "False", Toast.LENGTH_SHORT).show();
        }else {


            JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIDiagnostico, null, new Response.Listener<JSONArray>() {

                @Override
                public void onResponse(JSONArray response) {
                    diagnosticos = HospitalJsonParser.parserJsonDiagnosticos(response);
                    adicionarDiagnosticosBD(diagnosticos);


                    if(DiagnosticosListener != null){
                        DiagnosticosListener.onRefreshListaDiagnostico(hospitalDB.getAllDiagnosticosBD());
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

    public Diagnostico getDiagnostico(int id){
        for (Diagnostico l: diagnosticos)
            if (l.getId() == id)
                return l;
        return null;
    }

    public void adicionarDiagnosticosBD(ArrayList<Diagnostico> diagnosticos){
        hospitalDB.removerAllDiagnosticosBD();
        for(Diagnostico l: diagnosticos){
            adicionarDiagnosticoBD(l);
        }
    }
    public ArrayList<Diagnostico> getDiagnosticos(int id, ArrayList<Diagnostico> diagnosticos)
    {
        ArrayList<Diagnostico> auxdiagnostico = new ArrayList<>();
        for (Diagnostico m: diagnosticos) {
            if (id == m.getId_utente())
            {
                auxdiagnostico.add(m);
            }
        }
        return auxdiagnostico;
    }


    public void adicionarDiagnosticoBD(Diagnostico diagnostico){
        hospitalDB.adicionarDiagnosticoBD(diagnostico);
    }
    /******************************************************** Receitas ****************************************/
    public void getAllReceitasAPI(final Context context){

        if (!HospitalJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "False", Toast.LENGTH_SHORT).show();
        }else {


            JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIReceitas, null, new Response.Listener<JSONArray>() {

                @Override
                public void onResponse(JSONArray response) {
                    receitas = HospitalJsonParser.parserJsonReceitas(response);


                    adicionarReceitasBD(receitas);


                    if(ReceitasListener != null){
                        ReceitasListener.onRefreshListaReceitas(hospitalDB.getAllReceitasBD());
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

    public void adicionarReceitasBD(ArrayList<Receita> receitas){
        hospitalDB.removerAllReceitasBD();
        for(Receita l: receitas){
            adicionarReceitaBD(l);
        }
    }

    public void adicionarReceitaBD(Receita receita){
        hospitalDB.adicionarReceitaBD(receita);
    }




    /**************************** Especialidade **************************************/

    public Especialidade getEspecialidade(int id){
        for (Especialidade e: especialidades)
            if (e.getId() == id)
                return e;

        return null;
    }
    public ArrayList<String> getEspecialidadeNome(Profile profile) {
        ArrayList<String> nomeEspecialidade = new ArrayList<>();
        for (Especialidade e: especialidades) {
            for (MedicoEspecialidade me: medicoEspecialidades) {
                if (profile.getId() == me.getId_Medico() && me.getId_Especialidade() == e.getId())
                    nomeEspecialidade.add(e.getName());
            }
        }
        return nomeEspecialidade;
    }

    public ArrayList<Especialidade> getArrayEspecialidade(int id_especialidade) {
        ArrayList<Especialidade> auxEspecialidades = new ArrayList<>();
        for (Especialidade e: especialidades) {
            if (e.getId() == id_especialidade)
                auxEspecialidades.add(e);
        }
        return auxEspecialidades;
    }

    public ArrayList<Especialidade> getallEspecialidadeBD() {
        especialidades = hospitalDB.getAllEspecialidadeBD();
        return especialidades;
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

    /*************************** MedicoEspecialidade ****************************/

   /* public Especialidade getEspecialidade(String nome){
        for (Especialidade l: especialidades)
            if (l.getName().equals(nome))
                return l;
        return null;
    }*/
    public ArrayList<MedicoEspecialidade> getallMedicoEspecialidadeBD() {
        medicoEspecialidades = hospitalDB.getAllMedicoEspecialidadeBD();
        return medicoEspecialidades;
    }
    /*public ArrayList<String> getMedicoName(int id)
    {
        ArrayList<String> auMedico = new ArrayList<>();
            for (MedicoEspecialidade me: medicoEspecialidades)
            {
                for (Profile p: profiles)
                {
                    if (id == me.getId_Especialidade() && me.getId_Medico() == p.getId())
                        auMedico.add(p.getFirst_name());
                }
            }
        return auMedico;
    }*/


    public void getAllMedicoEspecialidadeAPI(final Context context){

        if (!HospitalJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "False", Toast.LENGTH_SHORT).show();
        }else {

            //JsonRequest req;
            // req = new JsonArrayRequest(Request.Method.GET, mUrlAPIMarcacao, null, new Response.Listener<JSONArray>()
            JsonRequest req =new JsonArrayRequest(Request.Method.GET, mUrlAPIMedicoEspecialidade, null, new Response.Listener<JSONArray>() {

                @Override
                public void onResponse(JSONArray response) {
                    medicoEspecialidades = HospitalJsonParser.parserJsonMedicoEspecialidades(response);
                    adicionarMedicoEspecialidadesBD(medicoEspecialidades);


                    if(medicoEspecialidadeListener != null){
                        medicoEspecialidadeListener.onRefreshListaMedicoEspecialidade(hospitalDB.getAllMedicoEspecialidadeBD());
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

    public void adicionarMedicoEspecialidadesBD(ArrayList<MedicoEspecialidade> medicoespecialidades){
        hospitalDB.removerAllMedicoEspecialidadesBD();
        for(MedicoEspecialidade me: medicoespecialidades){
            adicionarMedicoEspecialidadeBD(me);
        }
    }

    public void adicionarMedicoEspecialidadeBD(MedicoEspecialidade medicoEspecialidade){
        hospitalDB.adicionarMedicoEspecialidadeBD(medicoEspecialidade);
    }





}
