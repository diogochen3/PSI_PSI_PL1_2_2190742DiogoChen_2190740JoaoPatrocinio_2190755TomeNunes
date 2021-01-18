package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.net.ParseException;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class HospitalBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME="bd_Hospital";
    
    private static final int DB_VERSION=2;
    private static final int DATABASE_VERSION = 2;

    private final SQLiteDatabase db;

    private static final String TABLE_MARCACAO="marcacao";
    private static final String ID_MARCACAO="id";
    private static final String ID_ESPECIALIDADE_MARCACAO="id_especialidade";
    private static final String ID_UTENTE_MARCACAO="id_Utente";
    private static final String ID_MEDICO_MARCACAO="id_Medico";
    private static final String DATE_MARCACAO="date";
    private static final String TEMPO_MARCACAO="tempo";
    private static final String ACEITAR_MACACAO="Aceitar";
    private static final String IS_MEDICO_PROFILE = "is_medico";

    private static final String TABLE_PROFILE="profile";
    private static final String ID_PROFILE="id";
    private static final String PRIMEIRO_NOME_PROFILE="primeiroNome";
    private static final String APELIDO_PROFILE="apelido";
    private static final String EMAIL_PROFILE="email";
    private static final String TELEFONE_PROFILE="telefone";
    private static final String DATANASCIMENTO_PROFILE="dataNascimento";
    private static final String NIF_PROFILE="nif";
    private static final String ENDERECO_PROFILE="endereco";
    private static final String GENERO_PROFILE="genero";
    private static final String CODPOSTAL_PROFILE="codPostal";

    private static final String TABLE_ESPECIALIDADE="especialidade";
    private static final String ID_ESPECIALIDADE="id";
    private static final String NOME_ESPECIALIDADE="Name";



    public HospitalBDHelper(Context context) {
        super(context,DB_NAME,null, DB_VERSION);
        this.db= getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {
        String sqlCreateTableProfile="CREATE TABLE "+TABLE_PROFILE+"("+
                ID_PROFILE +" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                PRIMEIRO_NOME_PROFILE+ " TEXT NOT NULL, "+
                APELIDO_PROFILE+ " TEXT NOT NULL, "+
                EMAIL_PROFILE+ " TEXT NOT NULL, "+
                TELEFONE_PROFILE+ " INTEGER NOT NULL, "+
                NIF_PROFILE+ " INTEGER NOT NULL, "+
                ENDERECO_PROFILE+ " TEXT NOT NULL, " +
                DATANASCIMENTO_PROFILE+ " INTEGER NOT NULL, "+
                GENERO_PROFILE+ " TEXT NOT NULL, " +
                CODPOSTAL_PROFILE+ " TEXT NOT NULL, "+
                IS_MEDICO_PROFILE+ " TEXT NOT NULL "+
                ");";

        String sqlCreateTableMarcacao="CREATE TABLE "+TABLE_MARCACAO+"("+
                ID_MARCACAO +" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                DATE_MARCACAO + " TEXT NOT NULL, "+
                TEMPO_MARCACAO+ " TEXT NOT NULL, "+
                ACEITAR_MACACAO+ " INTEGER, "+
                ID_ESPECIALIDADE_MARCACAO+ " INTEGER NOT NULL, "+
                ID_UTENTE_MARCACAO+ " INTEGER NOT NULL, "+
                ID_MEDICO_MARCACAO+ " INTEGER NOT NULL " +
                ");";
        String sqlCreateTableEspecialidade="CREATE TABLE "+TABLE_ESPECIALIDADE+"("+
                ID_ESPECIALIDADE +" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                NOME_ESPECIALIDADE + " TEXT NOT NULL " +
                ");";

        sqLiteDatabase.execSQL(sqlCreateTableEspecialidade);
        sqLiteDatabase.execSQL(sqlCreateTableMarcacao);
        sqLiteDatabase.execSQL(sqlCreateTableProfile);

    }


    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {
        String sqlDropTableProfile="DROP TABLE IF EXISTS "+ TABLE_PROFILE;
        sqLiteDatabase.execSQL(sqlDropTableProfile);
        String sqlDropTableMarcacao="DROP TABLE IF EXISTS "+ TABLE_MARCACAO;
        sqLiteDatabase.execSQL(sqlDropTableMarcacao);
        String sqlDropTableEspecialidade="DROP TABLE IF EXISTS "+ TABLE_ESPECIALIDADE;
        sqLiteDatabase.execSQL(sqlDropTableEspecialidade);
        this.onCreate(sqLiteDatabase);
    }

    /***************************    PROFILE      ********************  *////////////////////////
    public ArrayList<Profile> getAllProfilesBD(){
        ArrayList<Profile> profiles=new ArrayList<>();
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");
        Cursor cursor=this.db.query(TABLE_PROFILE, new String[]{ID_PROFILE,
                PRIMEIRO_NOME_PROFILE,
                APELIDO_PROFILE,
                EMAIL_PROFILE,
                TELEFONE_PROFILE,
                NIF_PROFILE,
                ENDERECO_PROFILE,
                DATANASCIMENTO_PROFILE,
                GENERO_PROFILE,
                CODPOSTAL_PROFILE,
                IS_MEDICO_PROFILE}, null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Date date = null;
                try {
                    date = formatter.parse(cursor.getString(7));//DATANASCIMENTO_PROFILE
                } catch (ParseException e) {
                    e.printStackTrace();
                } catch (java.text.ParseException e) {
                    e.printStackTrace();
                }
                Profile auxProfile=new Profile(
                        cursor.getInt(0),//ID_PROFILE
                        cursor.getInt(4),//TELEFONE_PROFILE
                        cursor.getInt(5),//NIF_PROFILE
                        cursor.getInt(10),//IS_MEDICO_PROFILE
                        cursor.getString(1),//PRIMEIRO_NOME_PROFILE
                        cursor.getString(2),//APELIDO_PROFILE
                        cursor.getString(3),//EMAIL_PROFILE
                        cursor.getString(6),//ENDERECO_PROFILE
                        cursor.getString(9),//CODPOSTAL_PROFILE
                        cursor.getString(8),//GENERO_PROFILE
                        date
                );
                profiles.add(auxProfile);
            }while (cursor.moveToNext());
        }
        return profiles;
    }

    public void adicionarProfileBD(Profile profile){
        SimpleDateFormat dateFormatter = new SimpleDateFormat("yyyy-MM-dd");
        ContentValues values= new ContentValues();

        String date = dateFormatter.format(profile.getBirth_date());

        values.put(ID_PROFILE,profile.getId());
        values.put(PRIMEIRO_NOME_PROFILE,profile.getFirst_name());
        values.put(APELIDO_PROFILE,profile.getLast_name());
        values.put(EMAIL_PROFILE,profile.getEmail());
        values.put(TELEFONE_PROFILE,profile.getPhone_number());
        values.put(NIF_PROFILE,profile.getNIF());
        values.put(ENDERECO_PROFILE,profile.getAddress());
        values.put(DATANASCIMENTO_PROFILE,date);
        values.put(GENERO_PROFILE,profile.getGender());
        values.put(CODPOSTAL_PROFILE,profile.getPostal_code());
        values.put(IS_MEDICO_PROFILE,profile.getIs_medico());

        this.db.insert(TABLE_PROFILE,null,values);

       /* long id= this.db.insert(TABLE_LIVROS,null,values);
        if (id>-1){
            livro.setId((int)id);
            return livro;
        }*/

        //return livro;
        //return null;
    }

    public void  removerAllProfilesBD(){
        this.db.delete(TABLE_PROFILE,null,null);
    }


    /***************************    MARCACAO         ******************************////////////////////////

    public ArrayList<Marcacao> getAllMarcacoesBD(){
        ArrayList<Marcacao> marcacoes=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_MARCACAO, new String[]{
                ID_MARCACAO,
                        ID_ESPECIALIDADE_MARCACAO,
                        ID_MEDICO_MARCACAO,ID_UTENTE_MARCACAO,DATE_MARCACAO,TEMPO_MARCACAO,ACEITAR_MACACAO},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Marcacao auxMarcacao=new Marcacao(cursor.getInt(0),
                        cursor.getInt(1),
                        cursor.getInt(2),
                        cursor.getInt(3),
                        cursor.getString(4),
                        cursor.getString(5),
                        cursor.getInt(6));
                marcacoes.add(auxMarcacao);
            }while (cursor.moveToNext());
        }
        return marcacoes;
    }
    public void adicionarMarcacaoBD(Marcacao marcacao){
        ContentValues values= new ContentValues();
        values.put(ID_MARCACAO,marcacao.getId());
        values.put(ID_ESPECIALIDADE_MARCACAO,marcacao.getId_especialidade());
        values.put(ID_MEDICO_MARCACAO,marcacao.getId_Medico());
        values.put(ID_UTENTE_MARCACAO,marcacao.getId_Utente());
        values.put(DATE_MARCACAO ,marcacao.getDate());
        values.put(TEMPO_MARCACAO ,marcacao.getTempo());
        values.put(ACEITAR_MACACAO ,marcacao.getAceitar());

        this.db.insert(TABLE_MARCACAO,null,values);

       /* long id= this.db.insert(TABLE_LIVROS,null,values);
        if (id>-1){
            livro.setId((int)id);
            return livro;
        }*/

        //return livro;
        //return null;
    }
    public boolean editarMarcacaoBD(Marcacao marcacao) {
        ContentValues values= new ContentValues();
        values.put(DATE_MARCACAO, marcacao.getDate());
        values.put(TEMPO_MARCACAO,marcacao.getTempo());
        //values.put(ACEITAR_MACACAO,marcacao.getAceitar());
      //  values.put(ID_ESPECIALIDADE_MARCACAO,marcacao.getId_especialidade());
      //  values.put(ID_UTENTE_MARCACAO,marcacao.getId_Utente());
       // values.put(ID_MEDICO_MARCACAO,marcacao.getId_Medico());

        return this.db.update(TABLE_MARCACAO,values,"id=? ",new String[]{marcacao.getId() +""}) >0;
    }



    public void  removerAllMarcacoesBD(){
        this.db.delete(TABLE_MARCACAO,null,null);
    }


    public boolean removerLivroBD(int id) {
        return this.db.delete(TABLE_MARCACAO,"id=? ",new String[]{id +""}) >0;
    }

    /*************************   ESpecialidade   ******************************************************///
    public ArrayList<Especialidade> getAllEspecialidadeBD(){
        ArrayList<Especialidade> especialidades=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_ESPECIALIDADE, new String[]{
                        ID_MARCACAO,NOME_ESPECIALIDADE},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Especialidade auxEspecialidade =new Especialidade(cursor.getInt(0),
                        cursor.getString(1));
                especialidades.add(auxEspecialidade);
            }while (cursor.moveToNext());
        }
        return especialidades;
    }

    public ArrayList<String> getAllEspecialidadeNomeBD(){
        ArrayList<String> especialidades=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_ESPECIALIDADE, new String[]{
                        ID_MARCACAO,NOME_ESPECIALIDADE},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Especialidade auxEspecialidade =new Especialidade(cursor.getInt(0),
                        cursor.getString(1));
                especialidades.add(auxEspecialidade.getName());
            }while (cursor.moveToNext());
        }
        return especialidades;
    }


    public void adicionarEspecialidadeBD(Especialidade especialidade){

        ContentValues values= new ContentValues();

        values.put(ID_ESPECIALIDADE,especialidade.getId());
        values.put(NOME_ESPECIALIDADE,especialidade.getName());

        this.db.insert(TABLE_ESPECIALIDADE,null,values);

    }
    public void  removerAllEspecialidadesBD(){
        this.db.delete(TABLE_MARCACAO,null,null);
    }
}
