package amsi.dei.estg.ipleiria.healthschedule.views;

import android.Manifest;
import android.app.Activity;
import android.content.Context;
import android.content.ContextWrapper;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Canvas;
import android.graphics.Paint;
import android.graphics.pdf.PdfDocument;
import android.graphics.pdf.PdfDocument.Page;
import android.graphics.pdf.PdfDocument.PageInfo;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.print.PrintManager;
import android.util.AndroidException;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.Toast;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.annotation.Nullable;
import androidx.core.app.ActivityCompat;
import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.google.android.material.floatingactionbutton.FloatingActionButton;


public class AgendaFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, MarcacoesListener {

    private ListView lvListaMarcacoes;
    private static final int EDITAR=2;
    private static final int ADICIONAR=1;
    private int user_id,x=100,y=40;
    private Marcacao marcacao;
    private CardView marcacao_card;
    private SwipeRefreshLayout swipeRefreshLayout;
    private ArrayList<Profile> medico;
    private ArrayList<Marcacao> listaMarcacoes;
    private Button criarPDF;

    public AgendaFragment() {

    }




    public View onCreateView(LayoutInflater inflater, final ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_agenda, container, false);
        setHasOptionsMenu(true);

        criarPDF= view.findViewById(R.id.btnCreatePdf);

        criarPDF.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (ActivityCompat.checkSelfPermission(getContext(), Manifest.permission.WRITE_EXTERNAL_STORAGE) == PackageManager.PERMISSION_DENIED
                    && ActivityCompat.checkSelfPermission(getContext(),
                        Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_DENIED) {

                    ActivityCompat.requestPermissions(getActivity(), new String[]{
                            Manifest.permission.READ_EXTERNAL_STORAGE,
                                    Manifest.permission.WRITE_EXTERNAL_STORAGE},
                            PackageManager.PERMISSION_GRANTED);
                } else {
                    Log.e("DB", "PERMISSION GRANTED");
                }

                PdfDocument mypPdfDocument = new PdfDocument();
                PdfDocument.PageInfo myPageInfo = new PdfDocument.PageInfo.Builder(300,600,1).create();
                PdfDocument.Page myPage = mypPdfDocument.startPage(myPageInfo);

                Paint myPaint = new Paint();
                //String myString = myEditText.getText().toString();
                int x = 10, y=25;
                myPage.getCanvas().drawText("ola",x,y,myPaint);
              /*  for (String line:myString.split(“\n”)){
                    myPage.getCanvas().drawText(line, x, y, myPaint);
                    y+=myPaint.descent()-myPaint.ascent();
                }*/
                mypPdfDocument.finishPage(myPage);

                String myFilePath = Environment.getExternalStorageDirectory().getPath() + "/myPDFFile.pdf";
                File myFile = new File(myFilePath);
                try {
                    mypPdfDocument.writeTo(new FileOutputStream(myFile));
                }
                catch (Exception e){
                    e.printStackTrace();
                }

                mypPdfDocument.close();

                Canvas canvas = myPage.getCanvas();
                myPaint.setTextSize(30);
                for (Marcacao marcacaoitem : AdapterMarcacao.marcacoeslista){

                    canvas.drawText(marcacaoitem.getDate(), x, y , myPaint);
                }

                mypPdfDocument.finishPage(myPage);

                ContextWrapper cw = new ContextWrapper(getActivity().getApplicationContext());
                File directory = cw.getExternalCacheDir();
                Intent emailIntent = new Intent(Intent.ACTION_SEND);
                Uri URI =Uri.fromFile(directory);
                emailIntent.setData(Uri.parse("mailto:tome.nunes80@gmail.com"));
                emailIntent.setType("text/plain");
                emailIntent.putExtra(Intent.EXTRA_EMAIL  , new String[]{"Recipient"});
                emailIntent.putExtra(Intent.EXTRA_STREAM, URI);
                emailIntent.putExtra(Intent.EXTRA_TEXT   , "Message Body");
                File file = new File(directory , "marcacoes" + ".PDF");
                startActivity(Intent.createChooser(emailIntent, "Send mail..."));

                try {
                    mypPdfDocument.writeTo(new FileOutputStream(file));
                }catch (IOException e){
                    e.printStackTrace();
                }
                mypPdfDocument.close();

                /*String fileDirectory =;*/



            }
        });



        lvListaMarcacoes= view.findViewById(R.id.lv_agenda);
        marcacao_card = view.findViewById(R.id.marcacao_card);
        Bundle b3 = getArguments();
        user_id =b3.getInt("ID");
        // lvListaMarcacoes.setAdapter(new AdapterMarcacao(getContext(),listaMarcacoes));
        swipeRefreshLayout= view.findViewById(R.id.swipe_refresh_layout);
        swipeRefreshLayout.setOnRefreshListener(this);

        lvListaMarcacoes.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                //Toast.makeText(getContext(),"Livro com o id="+l,Toast.LENGTH_LONG).show();
                Intent intent=new Intent(getContext(),MarcacaoActivity.class);
                intent.putExtra("ID",(int) id);

                //startActivity(intent);
                startActivityForResult(intent,EDITAR);

            }
        });
        FloatingActionButton fab= view.findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                if(HospitalJsonParser.isConnectionInternet(getContext())){
                    Intent intent= new Intent(getContext(),MarcacaoActivity.class);
                    intent.putExtra("ID_USER",(int) user_id);
                    //startActivity(intent);
                    startActivityForResult(intent,ADICIONAR);
                }
            }
        });

        SingletonGestorHospital.getInstance(getContext()).setMarcacaoListener(this);
        SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());

      /*  if (listaMarcacoes != null){
            lvListaMarcacoes.setAdapter(new AdapterMarcacao(getActivity(),listaMarcacoes));
        }else{
            Toast.makeText(getContext(), "", Toast.LENGTH_SHORT).show();
        }*/

        return view;


    }


    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if (resultCode== Activity.RESULT_OK){
            switch (resultCode){
                case ADICIONAR:
                    SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
                    //lvListalivros.setAdapter(new ListaLivroAdaptador(getContext(),listaLivros));
                    Toast.makeText(getContext(),"Marcacao adicionado com sucesso",Toast.LENGTH_LONG);
                    //  Snackbar.make(getView(),"Livro adicionado com sucesso",Snackbar.LENGTH_LONG).show();
                    break;
                case EDITAR:
                    SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
                    //lvListalivros.setAdapter(new ListaLivroAdaptador(getContext(),listaLivros));
                    Toast.makeText(getContext(),"Marcacao editado com sucesso",Toast.LENGTH_LONG);
                    //  Snackbar.make(getView(),"Livro editado com sucesso",Snackbar.LENGTH_LONG).show();
                    break;
            }
        }
        super.onActivityResult(requestCode, resultCode, data);
    }


    @Override
    public void onResume() {
        listaMarcacoes = SingletonGestorHospital.getInstance(getContext()).getallMarcacaoBD();
        medico = SingletonGestorHospital.getInstance(getContext()).getallProfileBD();


        ArrayList<Marcacao> listaUserMarcacoes = SingletonGestorHospital.getInstance(getContext()).getMarcacoes(user_id,listaMarcacoes);


        lvListaMarcacoes.setAdapter(new AdapterMarcacao(getActivity(),listaUserMarcacoes, medico));
        // SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        super.onResume();
    }
    @Override
    public void onRefresh() {
        SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);

    }

    @Override
    public void onRefreshListaMarcacoes(ArrayList<Marcacao> marcacoes) {
        medico = SingletonGestorHospital.getInstance(getContext()).getallProfileBD();
        listaMarcacoes = SingletonGestorHospital.getInstance(getContext()).getMarcacoes(user_id,marcacoes);
        lvListaMarcacoes.setAdapter(new AdapterMarcacao(getContext(),listaMarcacoes,medico));
    }

    @Override
    public void onRefreshdetalhesMarcacoes() {

    }

}