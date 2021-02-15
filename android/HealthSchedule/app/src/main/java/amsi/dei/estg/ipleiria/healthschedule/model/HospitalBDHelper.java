package amsi.dei.estg.ipleiria.healthschedule.model;

import android.animation.ValueAnimator;
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
    
    private static final int DB_VERSION=16;
    private static final int DATABASE_VERSION = 2;


    private final SQLiteDatabase db;

    private static final String TABLE_MARCACAO="marcacao";
    private static final String ID_MARCACAO="id";
    private static final String ID_ESPECIALIDADE_MARCACAO="id_especialidade";
    private static final String ID_UTENTE_MARCACAO="id_Utente";
    private static final String ID_MEDICO_MARCACAO="id_Medico";
    private static final String ACEITAR_MACACAO="Aceitar";

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
    private static final String IMAGE_PROFILE="imagem";

    private static final String TABLE_ESPECIALIDADE="especialidade";
    private static final String ID_ESPECIALIDADE="id";
    private static final String NOME_ESPECIALIDADE="Name";


    private static final String TABLE_DIAGNOSTICO="diagnostico";
    private static final String ID_DIAGNOSTICO="id";
    private static final String DESCRICAO_DIAGNOSTICO="descricao";
    private static final String DATE_DIAGNOSTICO="date";
    private static final String SITUACAO_DIAGNOSTICO="situacao";
    private static final String ID_MEDICO_DIAGNOSTICO="id_medico";
    private static final String DID_UTENTE_DIAGNOSTICO="id_utente";


    private static final String TABLE_MEDICO_ESPECIALIDADE ="medico_especialidade";
    private static final String ID_MEDICO_MEDICO_ESPECIALIDADE="id_medico";
    private static final String ID_ESPECIALIDADE_MEDICO_ESPECIALIDADE="id_especialidade";

    private static final String TABLE_RECEITA="receitas";
    private static final String ID_RECEITA="id";
    private static final String COD_ACESSO_RECEITA="cod_accesso";
    private static final String COD_DISPENSA_RECEITA="cod_dispensa";
    private static final String DATA_EMISSAO_RECEITA="data_emissao";
    private static final String ID_CONSULTA_RECEITA="id_consulta";

    private static final String TABLE_RECEITAMEDICAMENTO = "receita_medicamento";
    private static final String ID_RECEITA_RECEITAMEDICAMENTO="id_receita";
    private static final String ID_MEDICAMENTO_RECEITAMEDICAMENTO="id_medicamento";
    private static final String QUANTIDADE_RECEITAMEDICAMENTO="quantidade";
    private static final String POSOLOGIA_RECEITAMEDICAMENTO="posologia";

    private static final String TABLE_MEDICAMENTO="medicamento";
    private static final String ID_MEDICAMENTO="id";
    private static final String NOME_MEDICAMENTO="nome_medicamento";
    private static final String DOSAGEM_MEDICAMENTO="dosagem";
    private static final String FORMA_FARMACEUTA_MEDICAMENTO="forma_farmaceuta";
    private static final String EMBALAGEM_MEDICAMENTO="embalagem";

    private static final String TABLE_HORARIO= "horario";
    private static final String ID_HORARIO="id";
    private static final String TEMPO_HORARIO="tempo";
    private static final String USADO_HORARIO="usado";
    private static final String ID_MEDICO_HORARIO="id_medico";

    public HospitalBDHelper(Context context) {
        super(context,DB_NAME,null, DB_VERSION);
        this.db= getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {
        String sqlCreateTableProfile="CREATE TABLE IF NOT EXISTS "+TABLE_PROFILE+"("+
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
                IMAGE_PROFILE+ " TEXT "+
                ");";

        String sqlCreateTableMarcacao="CREATE TABLE IF NOT EXISTS "+TABLE_MARCACAO+"("+
                ID_MARCACAO +" INTEGER PRIMARY KEY, "+
                ACEITAR_MACACAO+ " INTEGER, "+
                ID_ESPECIALIDADE_MARCACAO+ " INTEGER NOT NULL, "+
                ID_UTENTE_MARCACAO+ " INTEGER NOT NULL, "+
                ID_MEDICO_MARCACAO+ " INTEGER NOT NULL " +
                ");";

        String sqlCreateTableMedicoEspecialidade="CREATE TABLE IF NOT EXISTS "+TABLE_MEDICO_ESPECIALIDADE+"("+
                ID_MEDICO_MEDICO_ESPECIALIDADE+ " INTEGER NOT NULL, "+
                ID_ESPECIALIDADE_MEDICO_ESPECIALIDADE+ " INTEGER NOT NULL " +
                ");";

        String sqlCreateTableEspecialidade="CREATE TABLE IF NOT EXISTS "+TABLE_ESPECIALIDADE+"("+
                ID_ESPECIALIDADE +" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                NOME_ESPECIALIDADE + " TEXT NOT NULL " +
                ");";

        String sqlCreateTableDiagnostico="CREATE TABLE IF NOT EXISTS "+TABLE_DIAGNOSTICO+"("+
                ID_DIAGNOSTICO +" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                DESCRICAO_DIAGNOSTICO + " TEXT NOT NULL, "+
                DATE_DIAGNOSTICO+ " TEXT NOT NULL, "+
                SITUACAO_DIAGNOSTICO+ " TEXT NOT NULL, "+
                ID_MEDICO_DIAGNOSTICO+ " INTEGER NOT NULL, "+
                DID_UTENTE_DIAGNOSTICO+ " INTEGER NOT NULL "+
                ");";

        String sqlCreateTableHorario="CREATE TABLE IF NOT EXISTS "+TABLE_HORARIO+"("+
                ID_HORARIO+" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                TEMPO_HORARIO + " TEXT NOT NULL, "+
                USADO_HORARIO+ " INTEGER NOT NULL, "+
                ID_MEDICO_HORARIO+ " INTEGER NOT NULL "+
                ");";

        String sqlCreateTableReceita="CREATE TABLE IF NOT EXISTS "+TABLE_RECEITA+"("+
                ID_RECEITA +" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                COD_ACESSO_RECEITA + " INTEGER NOT NULL, "+
                COD_DISPENSA_RECEITA+ " INTEGER NOT NULL ,"+
                DATA_EMISSAO_RECEITA+ " TEXT NOT NULL ,"+
                ID_CONSULTA_RECEITA+ " INTEGER NOT NULL "+
                ");";
        String sqlCreateTableReceitaMedicamento="CREATE TABLE IF NOT EXISTS "+TABLE_RECEITAMEDICAMENTO+"("+
                ID_RECEITA_RECEITAMEDICAMENTO +" INTEGER , "+
                ID_MEDICAMENTO_RECEITAMEDICAMENTO + " INTEGER , "+
                QUANTIDADE_RECEITAMEDICAMENTO+ " INTEGER NOT NULL ,"+
                POSOLOGIA_RECEITAMEDICAMENTO+ " TEXT NOT NULL "+
                ");";
        String sqlCreateTableMedicamento="CREATE TABLE IF NOT EXISTS "+TABLE_MEDICAMENTO+"("+
                ID_MEDICAMENTO +" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                NOME_MEDICAMENTO + " TEXT NOT NULL, "+
                DOSAGEM_MEDICAMENTO+ " TEXT NOT NULL ,"+
                FORMA_FARMACEUTA_MEDICAMENTO+ " TEXT NOT NULL ,"+
                EMBALAGEM_MEDICAMENTO+ " TEXT NOT NULL "+
                ");";



        sqLiteDatabase.execSQL(sqlCreateTableEspecialidade);
        sqLiteDatabase.execSQL(sqlCreateTableMarcacao);
        sqLiteDatabase.execSQL(sqlCreateTableProfile);
        sqLiteDatabase.execSQL(sqlCreateTableDiagnostico);
        sqLiteDatabase.execSQL(sqlCreateTableMedicoEspecialidade);
        sqLiteDatabase.execSQL(sqlCreateTableHorario);
        sqLiteDatabase.execSQL(sqlCreateTableReceita);
        sqLiteDatabase.execSQL(sqlCreateTableReceitaMedicamento);
        sqLiteDatabase.execSQL(sqlCreateTableMedicamento);
    }


    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {
        String sqlDropTableProfile="DROP TABLE IF EXISTS "+ TABLE_PROFILE;
        sqLiteDatabase.execSQL(sqlDropTableProfile);
        String sqlDropTableMarcacao="DROP TABLE IF EXISTS "+ TABLE_MARCACAO;
        sqLiteDatabase.execSQL(sqlDropTableMarcacao);
        String sqlDropTableEspecialidade="DROP TABLE IF EXISTS "+ TABLE_ESPECIALIDADE;
        sqLiteDatabase.execSQL(sqlDropTableEspecialidade);
        String sqlDropTableDiagnostico="DROP TABLE IF EXISTS "+ TABLE_DIAGNOSTICO;
        sqLiteDatabase.execSQL(sqlDropTableDiagnostico);
        String sqlDropTableMedicoEspecialidade="DROP TABLE IF EXISTS "+ TABLE_MEDICO_ESPECIALIDADE;
        sqLiteDatabase.execSQL(sqlDropTableMedicoEspecialidade);
        String sqlDropTableReceita="DROP TABLE IF EXISTS "+ TABLE_RECEITA;
        sqLiteDatabase.execSQL(sqlDropTableReceita);
        String sqlDropTableHorario="DROP TABLE IF EXISTS "+ TABLE_HORARIO;
        sqLiteDatabase.execSQL(sqlDropTableHorario);
        String sqlDropTableReceitaMedicamento="DROP TABLE IF EXISTS "+ TABLE_RECEITAMEDICAMENTO;
        sqLiteDatabase.execSQL(sqlDropTableReceitaMedicamento);
        String sqlDropTableMedicamento ="DROP TABLE IF EXISTS "+ TABLE_MEDICAMENTO;
        sqLiteDatabase.execSQL(sqlDropTableMedicamento);
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
                IMAGE_PROFILE}, null,null,null,null,null);

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
                        cursor.getString(1),//PRIMEIRO_NOME_PROFILE
                        cursor.getString(2),//APELIDO_PROFILE
                        cursor.getString(3),//EMAIL_PROFILE
                        cursor.getString(6),//ENDERECO_PROFILE
                        cursor.getString(9),//CODPOSTAL_PROFILE
                        cursor.getString(8),//GENERO_PROFILE
                        date,
                        cursor.getString(10)
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
        values.put(IMAGE_PROFILE,profile.getImage());

        this.db.insert(TABLE_PROFILE,null,values);

       /* long id= this.db.insert(TABLE_LIVROS,null,values);
        if (id>-1){
            livro.setId((int)id);
            return livro;
        }*/

        //return livro;
        //return null;
    }
    public boolean editarProfileBD(Profile profile) {
        SimpleDateFormat dateFormatter = new SimpleDateFormat("yyyy-MM-dd");
        ContentValues values= new ContentValues();
        String date = dateFormatter.format(profile.getBirth_date());
        values.put(PRIMEIRO_NOME_PROFILE, profile.getFirst_name());
        values.put(APELIDO_PROFILE, profile.getLast_name());
        values.put(EMAIL_PROFILE, profile.getEmail());
        values.put(TELEFONE_PROFILE, profile.getPhone_number()+"");
        values.put(NIF_PROFILE, profile.getNIF()+"");
        values.put(ENDERECO_PROFILE, profile.getAddress());
        values.put(DATANASCIMENTO_PROFILE, date);
        values.put(GENERO_PROFILE, profile.getGender());
        values.put(CODPOSTAL_PROFILE, profile.getPostal_code());
        values.put(IMAGE_PROFILE,profile.getImage());
        //values.put(ACEITAR_MACACAO,marcacao.getAceitar());
        //  values.put(ID_ESPECIALIDADE_MARCACAO,marcacao.getId_especialidade());
        //  values.put(ID_UTENTE_MARCACAO,marcacao.getId_Utente());
        // values.put(ID_MEDICO_MARCACAO,marcacao.getId_Medico());

        return this.db.update(TABLE_PROFILE,values,"id=? ",new String[]{profile.getId() +""}) >0;
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
                        ID_MEDICO_MARCACAO,ID_UTENTE_MARCACAO,ACEITAR_MACACAO},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Marcacao auxMarcacao=new Marcacao(cursor.getInt(0),
                        cursor.getInt(1),
                        cursor.getInt(3),
                        cursor.getInt(2),
                        cursor.getInt(4));
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
        values.put(ACEITAR_MACACAO ,marcacao.getAceitar());

        this.db.insert(TABLE_MARCACAO,null,values);

    }

    public boolean editarMarcacaoBD(Marcacao marcacao) {
        ContentValues values= new ContentValues();
        values.put(ID_MARCACAO, marcacao.getId());
        //values.put(ACEITAR_MACACAO,marcacao.getAceitar());
        //  values.put(ID_ESPECIALIDADE_MARCACAO,marcacao.getId_especialidade());
        //  values.put(ID_UTENTE_MARCACAO,marcacao.getId_Utente());
        // values.put(ID_MEDICO_MARCACAO,marcacao.getId_Medico());

        return this.db.update(TABLE_MARCACAO,values,"id=? ",new String[]{marcacao.getId() +""}) >0;
    }



    public void  removerAllMarcacoesBD(){
        this.db.delete(TABLE_MARCACAO,null,null);
    }

    public boolean removerMarcacaoBD(int id) {
        return this.db.delete(TABLE_MARCACAO,"id=? ",new String[]{id +""}) >0;
    }

    /********************************************** Diagnostico  ****************************/
    public ArrayList<Diagnostico> getAllDiagnosticosBD(){
        ArrayList<Diagnostico> diagnosticos=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_DIAGNOSTICO, new String[]{
                ID_DIAGNOSTICO,
                        ID_MEDICO_DIAGNOSTICO,
                        DID_UTENTE_DIAGNOSTICO,DESCRICAO_DIAGNOSTICO,DATE_DIAGNOSTICO,SITUACAO_DIAGNOSTICO},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Diagnostico auxDiagnostico=new Diagnostico(cursor.getInt(0),
                        cursor.getInt(1),
                        cursor.getInt(2),
                        cursor.getString(4),
                        cursor.getString(3),
                        cursor.getString(5));
                diagnosticos.add(auxDiagnostico);
            }while (cursor.moveToNext());
        }
        return diagnosticos;
    }

    public void adicionarDiagnosticoBD(Diagnostico diagnostico){
        ContentValues values= new ContentValues();
        values.put(ID_DIAGNOSTICO,diagnostico.getId());
        values.put(DESCRICAO_DIAGNOSTICO,diagnostico.getDescricao());
        values.put(DATE_DIAGNOSTICO,diagnostico.getDate());
        values.put(SITUACAO_DIAGNOSTICO,diagnostico.getSituacao());
        values.put(ID_MEDICO_DIAGNOSTICO ,diagnostico.getId_medico());
        values.put(DID_UTENTE_DIAGNOSTICO,diagnostico.getId_utente());

        this.db.insert(TABLE_DIAGNOSTICO,null,values);
    }

    public ArrayList<Receita> getAllReceitasBD(){
        ArrayList<Receita> receitas=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_RECEITA, new String[]{
                        ID_RECEITA,
                        COD_ACESSO_RECEITA,
                        COD_DISPENSA_RECEITA,
                DATA_EMISSAO_RECEITA,
                ID_CONSULTA_RECEITA},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Receita auxReceita=new Receita(cursor.getInt(0),
                        cursor.getInt(1),
                        cursor.getInt(2),
                        cursor.getInt(4),
                        cursor.getString(3));
                receitas.add(auxReceita);
            }while (cursor.moveToNext());
        }
        return receitas;
    }




    public void adicionarReceitaBD(Receita receita){
        ContentValues values= new ContentValues();
        values.put(ID_RECEITA,receita.getId());
        values.put(COD_ACESSO_RECEITA,receita.getCodigo_acesso());
        values.put(COD_DISPENSA_RECEITA,receita.getCodigo_dispensa());
        values.put(DATA_EMISSAO_RECEITA,receita.getData_emissao());
        values.put(ID_CONSULTA_RECEITA,receita.getId_consulta());

        this.db.insert(TABLE_RECEITA,null,values);

       /* long id= this.db.insert(TABLE_LIVROS,null,values);
        if (id>-1){
            livro.setId((int)id);
            return livro;
        }*/

        //return livro;
        //return null;
    }



    public void  removerAllDiagnosticosBD(){
        this.db.delete(TABLE_DIAGNOSTICO,null,null);
    }
    public void  removerAllReceitasBD(){
        this.db.delete(TABLE_RECEITA,null,null);
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
        this.db.delete(TABLE_ESPECIALIDADE,null,null);
    }

    /*************************** MedicoEspecialidade ***********************************************************/
    public ArrayList<MedicoEspecialidade> getAllMedicoEspecialidadeBD(){
        ArrayList<MedicoEspecialidade> medicoEspecialidades=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_MEDICO_ESPECIALIDADE, new String[]{
                        ID_MEDICO_MEDICO_ESPECIALIDADE,ID_ESPECIALIDADE_MEDICO_ESPECIALIDADE},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                MedicoEspecialidade auxMedicoEspecialidade =new MedicoEspecialidade(cursor.getInt(1),
                        cursor.getInt(0));
                medicoEspecialidades.add(auxMedicoEspecialidade);
            }while (cursor.moveToNext());
        }
        return medicoEspecialidades;
    }


    public void adicionarMedicoEspecialidadeBD(MedicoEspecialidade medicoEspecialidade){

        ContentValues values= new ContentValues();

        values.put(ID_MEDICO_MEDICO_ESPECIALIDADE,medicoEspecialidade.getId_Medico());
        values.put(ID_ESPECIALIDADE_MEDICO_ESPECIALIDADE,medicoEspecialidade.getId_Especialidade());

        this.db.insert(TABLE_MEDICO_ESPECIALIDADE,null,values);

    }
    public void  removerAllMedicoEspecialidadesBD(){
        this.db.delete(TABLE_MEDICO_ESPECIALIDADE,null,null);
    }
    
    public void removerAllHorariosBD() {
        this.db.delete(TABLE_HORARIO,null,null);
    }

    public void adicionarHorarioBD(Horario horario) {
        ContentValues values= new ContentValues();
        
        values.put(ID_HORARIO,horario.getId());
        values.put(TEMPO_HORARIO,horario.gettempo());
        values.put(USADO_HORARIO,horario.getUsado());
        values.put(ID_MEDICO_HORARIO,horario.getId_medico());

        this.db.insert(TABLE_HORARIO,null,values);
    }

    public ArrayList<Horario> getAllHorariosBD() {
        ArrayList<Horario> horarios=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_HORARIO, new String[]{
                        ID_HORARIO,TEMPO_HORARIO, USADO_HORARIO, ID_MEDICO_HORARIO},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Horario auxHorario =new Horario(cursor.getInt(0),
                        cursor.getInt(2),cursor.getInt(3),cursor.getString(1));
                horarios.add(auxHorario);
            }while (cursor.moveToNext());
        }
        return horarios;
    }

    public boolean editarHorarioBD(Horario horario) {
        ContentValues values= new ContentValues();

        values.put(TEMPO_HORARIO, horario.gettempo());
        values.put(USADO_HORARIO, horario.getUsado());
        values.put(ID_MEDICO_HORARIO, horario.getId_medico());

        return this.db.update(TABLE_HORARIO,values,"id=? ",new String[]{horario.getId() +""}) >0;
    }

    /******************************** ReceitaMedicamento **************************************************/

    public void removerAllReceitaMedicamentoBD() {
        this.db.delete(TABLE_RECEITAMEDICAMENTO,null,null);
    }

    public void adicionarReceitaMedicamentoBD(ReceitaMedicamento rm) {
        ContentValues values= new ContentValues();

        values.put(ID_RECEITA_RECEITAMEDICAMENTO,rm.getId_receita());
        values.put(ID_MEDICAMENTO_RECEITAMEDICAMENTO,rm.getId_medicamento());
        values.put(QUANTIDADE_RECEITAMEDICAMENTO,rm.getQuantidade());
        values.put(POSOLOGIA_RECEITAMEDICAMENTO,rm.getPosologia());

        this.db.insert(TABLE_RECEITAMEDICAMENTO,null,values);
    }

    public ArrayList<ReceitaMedicamento> getAllReceitaMedicamentosBD() {
        ArrayList<ReceitaMedicamento> receitaMedicamentos=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_RECEITAMEDICAMENTO, new String[]{
                        ID_RECEITA_RECEITAMEDICAMENTO,ID_MEDICAMENTO_RECEITAMEDICAMENTO,QUANTIDADE_RECEITAMEDICAMENTO, POSOLOGIA_RECEITAMEDICAMENTO},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                ReceitaMedicamento auxReceitaMedicamento =new ReceitaMedicamento(cursor.getInt(0),
                        cursor.getInt(1),cursor.getInt(2),cursor.getString(3));
                receitaMedicamentos.add(auxReceitaMedicamento);
            }while (cursor.moveToNext());
        }
        return receitaMedicamentos;
    }

    public void removerAllMedicamentosBD() {
        this.db.delete(TABLE_MEDICAMENTO,null,null);
    }

    public void adicionarMedicamentoBD(Medicamento m) {
        ContentValues values= new ContentValues();

        values.put(ID_MEDICAMENTO,m.getId());
        values.put(NOME_MEDICAMENTO,m.getNome_medicamento());
        values.put(DOSAGEM_MEDICAMENTO,m.getDosagem());
        values.put(FORMA_FARMACEUTA_MEDICAMENTO,m.getForma_farmaceuta());
        values.put(EMBALAGEM_MEDICAMENTO,m.getEmbalagem());

        this.db.insert(TABLE_MEDICAMENTO,null,values);
    }
    public ArrayList<Medicamento> getAllMedicamentosBD() {

            ArrayList<Medicamento> medicamentos=new ArrayList<>();
            Cursor cursor=this.db.query(TABLE_MEDICAMENTO, new String[]{
                            ID_MEDICAMENTO,NOME_MEDICAMENTO,DOSAGEM_MEDICAMENTO,FORMA_FARMACEUTA_MEDICAMENTO,EMBALAGEM_MEDICAMENTO},
                    null,null,null,null,null);

            if (cursor.moveToFirst()){
                do {
                    Medicamento auxMedicamento =new Medicamento(cursor.getInt(0),
                            cursor.getString(1),cursor.getString(2),cursor.getString(4),cursor.getString(3));
                    medicamentos.add(auxMedicamento);
                }while (cursor.moveToNext());
            }
            return medicamentos;
    }





}
