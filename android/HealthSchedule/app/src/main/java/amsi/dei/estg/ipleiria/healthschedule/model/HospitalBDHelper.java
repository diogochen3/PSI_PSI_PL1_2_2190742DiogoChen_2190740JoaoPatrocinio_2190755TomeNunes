package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class HospitalBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME="bd_Hospital";
    private static final int DB_VERSION=1;
    private static final String TABLE_MARCACAO="marcacoes";
    private static final String ID_MARCACAO="id";
    private static final String id_especialidade="id_especialidade";
    private static final String id_Utente="id_Utente";
    private static final String id_Medico="id_Medico";
    private static final String date="date";
    private static final String tempo="tempo";
    private static final String Aceitar="Aceitar";

    private final SQLiteDatabase db;


    public HospitalBDHelper(Context context) {


        super(context,DB_NAME,null, DB_VERSION);
        this.db=getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {

    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {

    }
    public void  removerAllMarcacoesBD(){
        this.db.delete(TABLE_MARCACAO,null,null);
    }
    public ArrayList<Marcacao> getAllMarcacoesBD(){
        ArrayList<Marcacao> marcacoes=new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_MARCACAO, new String[]{ID_MARCACAO,id_especialidade,id_Medico,id_Utente,date,tempo,Aceitar},
                null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Marcacao auxMarcacao=new Marcacao(cursor.getInt(0),
                        cursor.getInt(1),
                        cursor.getInt(2),
                        cursor.getInt(3),
                        cursor.getString(4),
                        cursor.getString(5),
                        cursor.getString(6));
                marcacoes.add(auxMarcacao);
            }while (cursor.moveToNext());
        }
        return marcacoes;
    }
    public void adicionarMarcacaoBD(Marcacao marcacao){
        ContentValues values= new ContentValues();
        values.put(ID_MARCACAO,marcacao.getId());
        values.put(id_especialidade,marcacao.getId_especialidade());
        values.put(id_Medico,marcacao.getId_Medico());
        values.put(id_Utente,marcacao.getId_Utente());
        values.put(date,marcacao.getDate());
        values.put(tempo,marcacao.getTempo());
        values.put(Aceitar,marcacao.getAceitar());

        this.db.insert(TABLE_MARCACAO,null,values);

       /* long id= this.db.insert(TABLE_LIVROS,null,values);
        if (id>-1){
            livro.setId((int)id);
            return livro;
        }*/

        //return livro;
        //return null;
    }

}
