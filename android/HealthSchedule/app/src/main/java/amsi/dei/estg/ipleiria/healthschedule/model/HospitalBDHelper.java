package amsi.dei.estg.ipleiria.healthschedule.model;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class HospitalBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME="bd_Hospital";
    private static final int DB_VERSION=1;
    private final SQLiteDatabase db;

    private static final String TABLE_PROFILE="profile";
    private static final String ID_PROFILE="id";
    private static final String PRIMEIRO_NOME_PROFILE="primeiroNome";
    private static final String APELIDO_PROFILE="apelido";
    private static final String EMAIL_PROFILE="email";
    private static final String TELEFONE_PROFILE="telefone";
    private static final String DATANASCIMENTO_PROFILE="telefone";
    private static final String NIF_PROFILE="nif";
    private static final String ENDERECO_PROFILE="endereco";
    private static final String GENERO_PROFILE="genero";
    private static final String CODPOSTAL_PROFILE="codPostal";

    public HospitalBDHelper(Context context) {
        super(context,DB_NAME,null, DB_VERSION);
        this.db=getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {
        String sqlCreateTableLivro="CREATE TABLE "+TABLE_PROFILE+"("+
                ID_PROFILE +" INTEGER PRIMARY KEY AUTOINCREMENT, "+
                PRIMEIRO_NOME_PROFILE+ " TEXT NOT NULL, "+
                APELIDO_PROFILE+ " TEXT NOT NULL, "+
                EMAIL_PROFILE+ " TEXT NOT NULL, "+
                TELEFONE_PROFILE+ " TEXT NOT NULL, "+
                NIF_PROFILE+ " INTEGER NOT NULL, "+
                ENDERECO_PROFILE+ " TEXT NOT NULL, " +
                DATANASCIMENTO_PROFILE+ " INTEGER NOT NULL, "+
                GENERO_PROFILE+ " INTEGER NOT NULL, " +
                CODPOSTAL_PROFILE+ " TEXT NOT NULL "+
                ");";

        db.execSQL(sqlCreateTableLivro);
    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {
        String sqlDropTableLivro="DROP TABLE IF EXISTS "+ TABLE_PROFILE;
        db.execSQL(sqlDropTableLivro);
        this.onCreate(db);
    }

    /********************** METODOS CRUD ******************************************/


    /**
     * INSERT
     * metodo insert() -> return idlivro(long) se houver erro devolve -1
     * @param profile
     * @return
     */

    public void adicionarProfileBD(Profile profile){
        ContentValues values= new ContentValues();
        values.put(ID_PROFILE,profile.getId());
        values.put(PRIMEIRO_NOME_PROFILE,profile.getpNome());
        values.put(APELIDO_PROFILE,profile.getApelido());
        values.put(EMAIL_PROFILE,profile.getEmail());
        values.put(TELEFONE_PROFILE,profile.getTelefone());
        values.put(NIF_PROFILE,profile.getTelefone());
        values.put(ENDERECO_PROFILE,profile.getTelefone());
        values.put(DATANASCIMENTO_PROFILE,profile.getTelefone());
        values.put(GENERO_PROFILE,profile.getTelefone());
        values.put(CODPOSTAL_PROFILE,profile.getTelefone());

        this.db.insert(TABLE_PROFILE,null,values);

       /* long id= this.db.insert(TABLE_LIVROS,null,values);
        if (id>-1){
            livro.setId((int)id);
            return livro;
        }*/

        //return livro;
        //return null;
    }



    /**
     * EDIT
     * metodo update() -> return  nº de linhas alteradas
     * @param livro
     * @return
     */

   /* public boolean editarLivroBD(Livro livro){
        ContentValues values= new ContentValues();
        values.put(TITULO_LIVRO,livro.getTitulo());
        values.put(SERIE_LIVRO,livro.getSerie());
        values.put(AUTOR_LIVRO,livro.getAutor());
        values.put(ANO_LIVRO,livro.getAno());
        values.put(CAPA_LIVRO,livro.getCapa());

        return this.db.update(TABLE_LIVROS,values,"id=? ",new String[]{livro.getId() +""}) >0;
    }*/



    /**
     * DELETE
     * metodo delete() -> return  nº de linhas alteradas
     * @param id
     * @return
     */

    public boolean removerProfileBD(int id){

        return this.db.delete(TABLE_PROFILE,"id=? ",new String[]{id +""}) >0;
    }


    public void  removerAllProfilesBD(){
        this.db.delete(TABLE_PROFILE,null,null);
    }

    /**
     * SELECT
     * this.db.rawQuery("Codigo sql",null)-> susceptivel de SQLINJETION
     * @return
     */


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
                        CODPOSTAL_PROFILE}, null,null,null,null,null);

        if (cursor.moveToFirst()){
            do {
                Date date = null;
                try {
                    date = formatter.parse(cursor.getString(7));
                } catch (ParseException e) {
                    e.printStackTrace();
                }
                Profile auxProfile=new Profile(
                        cursor.getInt(0),
                        cursor.getString(1),
                        cursor.getString(2),
                        cursor.getString(3),
                        cursor.getInt(4),
                        cursor.getInt(5),
                        cursor.getString(6),
                        date,
                        cursor.getString(8),
                        cursor.getString(9)
                        );
                profiles.add(auxProfile);
            }while (cursor.moveToNext());
        }
        return profiles;
    }

}
