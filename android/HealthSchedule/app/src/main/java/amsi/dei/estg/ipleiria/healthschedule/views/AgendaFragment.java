package amsi.dei.estg.ipleiria.healthschedule.views;

import android.Manifest;
import android.app.Activity;
import android.content.ContextWrapper;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.pdf.PdfDocument;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.os.StrictMode;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

import java.io.File;
import java.io.FileOutputStream;
import java.lang.reflect.Method;
import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Horario;
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
    private int user_id,x=50,y=40;
    private Marcacao marcacao;
    private CardView marcacao_card;
    private SwipeRefreshLayout swipeRefreshLayout;
    private ArrayList<Profile> medico;
    private ArrayList<Marcacao> listaMarcacoes;
    private ArrayList<Especialidade> listaEspecialidade;
    private Button criarPDF;
    private String medicos;
    private ArrayList<Horario> horarios;

    public AgendaFragment() {

    }




    public View onCreateView(LayoutInflater inflater, final ViewGroup container,
                             Bundle savedInstanceState) {
        if (Build.VERSION.SDK_INT >= 24) {
            try {
                Method m = StrictMode.class.getMethod("disableDeathOnFileUriExposure");
                m.invoke(null);
            } catch (Exception e) {
                e.printStackTrace();
            }
            }
        View view = inflater.inflate(R.layout.fragment_agenda, container, false);
        setHasOptionsMenu(true);
        horarios = SingletonGestorHospital.getInstance(getContext()).getallHorariosBD();

        SingletonGestorHospital.getInstance(getContext()).setMarcacaoListener(this);

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
                PdfDocument.PageInfo myPageInfo = new PdfDocument.PageInfo.Builder(700,1000,1).create();
                PdfDocument.Page myPage = mypPdfDocument.startPage(myPageInfo);

                Paint myPaint = new Paint();
                //String myString = myEditText.getText().toString();
                Canvas canvas = myPage.getCanvas();


                ArrayList<Marcacao> listaUserMarcacoes = SingletonGestorHospital.getInstance(getContext()).getMarcacoes(user_id,listaMarcacoes);
                myPaint.setColor(Color.BLUE);
                x=100;
                canvas.drawText("Hora:", x, y , myPaint);
                x=200;
                canvas.drawText("medico:", x, y , myPaint);
                x=300;
                canvas.drawText("especialidade:", x, y , myPaint);
                x=400;
                canvas.drawText("Data:", x, y , myPaint);
                y=y+50;
                myPaint.setColor(Color.BLACK);
                for (Marcacao marcacaoitem : listaUserMarcacoes){
                    x=100;
                    Horario horario = SingletonGestorHospital.getInstance(getContext()).gethorario(marcacaoitem.getId());
                    canvas.drawText(horario.gettempo(), x, y , myPaint);

                    for (Profile profileitem : medico){
                        if (marcacaoitem.getId_Medico() == profileitem.getId()) {
                            x=200;
                            myPage.getCanvas().drawText(profileitem.getFirst_name(), x, y, myPaint);

                        }
                        }
                    for (Especialidade especialidadeitem : listaEspecialidade){
                        if (marcacaoitem.getId_especialidade() == especialidadeitem.getId()) {
                            x=300;
                            myPage.getCanvas().drawText(especialidadeitem.getName(), x, y, myPaint);

                        }
                    }
                    x=400;

                    y=y+14;

}
                mypPdfDocument.finishPage(myPage);

                String myFilePath = Environment.getExternalStorageDirectory().getPath() + "/listademarcacoes.pdf";
                File myFile = new File(myFilePath);
                ContextWrapper cw = new ContextWrapper(getActivity().getApplicationContext());
                File directory = cw.getExternalCacheDir();
                Intent emailIntent = new Intent(Intent.ACTION_SEND);
                Uri URI =Uri.fromFile(myFile);
                emailIntent.setData(Uri.parse("mailto:tome.nunes800@gmail.com"));
                emailIntent.setType("text/plain");
                emailIntent.putExtra(Intent.EXTRA_EMAIL  , new String[]{"tome.nunes80@gmail.com"});
                emailIntent.putExtra(Intent.EXTRA_STREAM, URI);
                emailIntent.putExtra(Intent.EXTRA_TEXT   , "aqui está o pdf");
                startActivity(Intent.createChooser(emailIntent, "A enviar..."));
                try {
                    mypPdfDocument.writeTo(new FileOutputStream(myFile));
                }
                catch (Exception e){
                    e.printStackTrace();
                }
                mypPdfDocument.close();


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
        listaEspecialidade = SingletonGestorHospital.getInstance(getContext()).getallEspecialidadeBD();



        ArrayList<Marcacao> listaUserMarcacoes = SingletonGestorHospital.getInstance(getContext()).getMarcacoes(user_id,listaMarcacoes);


        lvListaMarcacoes.setAdapter(new AdapterMarcacao(getActivity(),listaUserMarcacoes, medico, horarios));
        // SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        super.onResume();
    }
    @Override
    public void onRefresh() {
        SingletonGestorHospital.getInstance(getContext()).getAllHorarioAPI(getContext());
        SingletonGestorHospital.getInstance(getContext()).getAllMarcacaoAPI(getContext());
        swipeRefreshLayout.setRefreshing(false);

    }

    @Override
    public void onRefreshListaMarcacoes(ArrayList<Marcacao> marcacoes) {
        medico = SingletonGestorHospital.getInstance(getContext()).getallProfileBD();
        listaMarcacoes = SingletonGestorHospital.getInstance(getContext()).getMarcacoes(user_id,marcacoes);
        lvListaMarcacoes.setAdapter(new AdapterMarcacao(getContext(),listaMarcacoes,medico,horarios));
    }

    @Override
    public void onRefreshdetalhesMarcacoes() {

    }

}