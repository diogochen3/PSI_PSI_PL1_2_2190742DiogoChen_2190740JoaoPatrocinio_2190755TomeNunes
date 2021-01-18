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

import amsi.dei.estg.ipleiria.healthschedule.model.Diagnostico;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.MedicoEspecialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;

public class HospitalJsonParser {

    public static String parserJsonLogin(String response) {
        String token = null;

        try {
            JSONObject login = new JSONObject(response);
            if (login.getBoolean("success")) {
                token = login.getString("token");
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }

        return token;
    }

    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo ni = cm.getActiveNetworkInfo();
        boolean bool;
        if (ni != null && ni.isConnected())
        {
             bool = true;
        }
        else
             bool = false;

        return bool;
    }


    public static ArrayList<Marcacao> parserJsonMarcacoes(JSONArray response) {
        ArrayList<Marcacao> marcacoes = new ArrayList<>();
        if (response != null) {
            for (int i = 0; i < response.length(); i++) {
                try {
                    JSONObject marcacao = (JSONObject) response.get(i);
                    int id = marcacao.getInt("id");
                    String date = marcacao.getString("date");
                    String tempo = marcacao.getString("tempo");
                    int Aceitar = marcacao.getInt("Aceitar");
                    int id_especialidade = marcacao.getInt("id_especialidade");
                    int id_Utente = marcacao.getInt("id_Utente");
                    int id_Medico = marcacao.getInt("id_Medico");
                    Marcacao l = new Marcacao(id, id_especialidade, id_Utente, id_Medico, date, tempo, Aceitar);
                    marcacoes.add(l);

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }

        return marcacoes;
    }
    public static ArrayList<Diagnostico> parserJsonDiagnosticos(JSONArray response) {
        ArrayList<Diagnostico> diagnosticos = new ArrayList<>();
        if (response != null) {
            for (int i = 0; i < response.length(); i++) {
                try {
                    JSONObject diagnostico = (JSONObject) response.get(i);
                    int id = diagnostico.getInt("id");
                    String descricao = diagnostico.getString("descricao");
                    String date = diagnostico.getString("date");
                    String situacao = diagnostico.getString("situacao");
                    int id_Utente = diagnostico.getInt("id_utente");
                    int id_Medico = diagnostico.getInt("id_medico");


                    Diagnostico l = new Diagnostico(id, id_Medico, id_Utente,date, descricao, situacao);
                    diagnosticos.add(l);

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }

        return diagnosticos;
    }
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
                    int is_medico = profile.getInt("is_medico");
                    Date date = formatter.parse(dNascimento);

                    Profile p = new Profile(id, telefone, nif, is_medico,pNome,apelido,email,endereco,codPostal,genero,date);
                    profiles.add(p);
                } catch (ParseException | JSONException e) {
                    e.printStackTrace();
                }
            }
        }
        return profiles;
    }


    public static Marcacao parserJsonMarcacao(String response) {
        Marcacao auxMarcacao = null;


        try {

            JSONObject marcacao = new JSONObject(response);
            int id = marcacao.getInt("id");
            String date = marcacao.getString("date");
            String tempo = marcacao.getString("tempo");
            int aceitar = marcacao.getInt("Aceitar");
            int id_especialidade = marcacao.getInt("id_especialidade");
            int id_utente = marcacao.getInt("id_Utente");
            int id_medico = marcacao.getInt("id_Medico");

            auxMarcacao= new Marcacao(id,id_especialidade,id_utente,id_medico,date,tempo,aceitar);

        } catch(JSONException e) {
            e.printStackTrace();
        }

        return auxMarcacao;
    }

    public static ArrayList<Especialidade> parserJsonEspecialidades(JSONArray response) {

        ArrayList<Especialidade> especialidades = new ArrayList<>();
        if (response != null) {
            for (int i = 0; i < response.length(); i++) {
                try {
                    JSONObject profile = (JSONObject) response.get(i);
                    int id = profile.getInt("id");
                    String name = profile.getString("Name");

                    Especialidade p = new Especialidade(id, name);
                    especialidades.add(p);
                /*} catch (ParseException e) {
                    e.printStackTrace();*/
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
        return especialidades;
    }

    public static ArrayList<MedicoEspecialidade> parserJsonMedicoEspecialidades(JSONArray response) {

        ArrayList<MedicoEspecialidade> medicoEspecialidades = new ArrayList<>();
        if (response != null) {
            for (int i = 0; i < response.length(); i++) {
                try {
                    JSONObject medicoEpecialidade = (JSONObject) response.get(i);
                    int id_especialidade = medicoEpecialidade.getInt("id");
                    int id_medico = medicoEpecialidade.getInt("");

                    MedicoEspecialidade me = new MedicoEspecialidade(id_especialidade, id_medico);
                    medicoEspecialidades.add(me);
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
        return medicoEspecialidades;
    }
}
