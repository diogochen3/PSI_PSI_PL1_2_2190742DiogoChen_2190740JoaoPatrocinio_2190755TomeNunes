package amsi.dei.estg.ipleiria.healthschedule.views;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterEspecialidade;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterNomeMedicos;
import amsi.dei.estg.ipleiria.healthschedule.listeners.EspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MedicoEspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.MedicoEspecialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.app.TimePickerDialog;
import android.content.DialogInterface;
import android.os.Build;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.ArrayAdapter;
import android.widget.CalendarView;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;
import java.util.Calendar;

public class MarcacaoActivity extends AppCompatActivity  implements MarcacoesListener, EspecialidadeListener, MedicoEspecialidadeListener {

    public static final String ID = "ID";
    private Marcacao marcacao;
    private int id_especialidade;
    private int id_medico;
    private ArrayList<MedicoEspecialidade> medicoEspecialidades;

    private Spinner spMedico, spEspecialidade;
    private ArrayAdapter arrayAdapter;
    private ArrayList<Especialidade> especialidade;
    private ArrayList<Profile> medico;

    private TimePicker tpTime;
    private CalendarView cvDate;
    private String date, time;
    private int hour, minute;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_marcacao);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        final int id = getIntent().getIntExtra(ID,0);
        marcacao = SingletonGestorHospital.getInstance(getApplicationContext()).getMarcacao(id);


        SingletonGestorHospital.getInstance(getApplicationContext()).setEspecialidadeListener(this);

        SingletonGestorHospital.getInstance(getApplicationContext()).setMarcacaoListener(this);
        SingletonGestorHospital.getInstance(getApplicationContext()).getAllEspecialidadeAPI(getApplicationContext());
        SingletonGestorHospital.getInstance(getApplicationContext()).getAllMedicoEspecialidadeAPI(getApplicationContext());

        FloatingActionButton fab = findViewById(R.id.fab);
        spEspecialidade = findViewById(R.id.spEspecialidade);
        spMedico = findViewById(R.id.spMedico);
        tpTime = findViewById(R.id.tpTime);
        cvDate = findViewById(R.id.cvDate);
        tpTime.setIs24HourView(true);


        spEspecialidade.setOnItemSelectedListener(new OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                Toast.makeText(getApplicationContext(),"pos"+position,Toast.LENGTH_LONG);
                Toast.makeText(getApplicationContext(),"id"+id,Toast.LENGTH_LONG);
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });

        cvDate.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            @Override
            public void onSelectedDayChange(@NonNull CalendarView calendarView, int i, int i1, int i2) {
                date = i+"/" + i1 + "/" +i2;
            }
        });


        if (marcacao != null){
           // setTitle("Detalhes"+livro.getTitulo());
            carregarDetalhesMarcacao();
            fab.setImageResource(R.drawable.ic_action_guardar);
        }else{
            setTitle("Marcar");
            fab.setImageResource(R.drawable.ic_action_adicionar);
           /* arrayAdapter=new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, especialidade);
            spEspecialidade.setAdapter(arrayAdapter);*/

        }

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(HospitalJsonParser.isConnectionInternet(getApplicationContext())){
                    if (marcacao!=null){

                        /*marcacao.setDate(date);
                        marcacao.setTempo(etTime.getText().toString());*/

                        SingletonGestorHospital.getInstance(getApplicationContext()).editarMarcacaoAPI(marcacao,getApplicationContext());
                    }
                    else
                    if (validarMarcaco()==true){
                        if (Build.VERSION.SDK_INT >= 23 ){
                            hour = tpTime.getHour();
                            minute = tpTime.getMinute();
                        }
                        else{
                            hour = tpTime.getCurrentHour();
                            minute = tpTime.getCurrentMinute();
                        }
                        time = hour +":" +minute+ ":00";
                        marcacao = new Marcacao(0,id_especialidade,21,id_medico,date,time,0);
                        SingletonGestorHospital.getInstance(getApplicationContext()).adicionarMarcacaoAPI(marcacao,getApplicationContext());
                    }else return;
                    // setResult(RESULT_OK);
                    //finish();
                }

            }
        });

          SingletonGestorHospital.getInstance(getApplicationContext()).getAllMedicoEspecialidadeAPI(getApplicationContext());


        spEspecialidade.setOnItemSelectedListener(new OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                medico = SingletonGestorHospital.getInstance(getApplicationContext()).getMedico(id);
                spMedico.setAdapter(new AdapterNomeMedicos(getApplicationContext(),medico));
                id_especialidade = (int) id;
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }

        });


<<<<<<< HEAD
=======
        spMedico.setOnItemSelectedListener(new OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                id_medico = (int) id;
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }

        });

>>>>>>> 0ac6b5e4e9097183e2896db8fd20a28a04e5fd1d
    }




    private void carregarDetalhesMarcacao() {

    }

    private boolean validarMarcaco() {
        return true;
    }


    @Override
    public void onRefreshListaMarcacoes(ArrayList<Marcacao> marcacoes) {

    }

    @Override
    public void onRefreshdetalhesLivros() {
        setResult(RESULT_OK);
        finish();
    }


    @Override
    public void onRefreshListaEspecialidade(ArrayList<Especialidade> especialidades) {
        spEspecialidade.setAdapter(new AdapterEspecialidade(getApplicationContext(),especialidades));
        //spEspecialidade.setAdapter(new Adapter(getApplicationContext(),especialidades));
    }

    @Override
    public void onRefreshListaMedicoEspecialidade(ArrayList<MedicoEspecialidade> medicoEspecialidade) {
        medicoEspecialidades = medicoEspecialidade;
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        if (marcacao!= null){
            MenuInflater inflater=getMenuInflater();
            inflater.inflate(R.menu.menu_remover_marcaco,menu);
            return super.onCreateOptionsMenu(menu);
        }
        return false;
    }

    /**
     * ejetar operações do um item do menu é clicado
     * @param item
     * @return
     */
    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()){
            case R.id.remover:
                if(HospitalJsonParser.isConnectionInternet(getApplicationContext())){
                    dialogRemover();
                }else return true;
                break;
        }
        return super.onOptionsItemSelected(item);
    }

    private void dialogRemover() {
        AlertDialog.Builder builder= new AlertDialog.Builder(this);
        builder.setTitle("Remover Livro").setMessage("Pretende mesmo remover o livro").setIcon(android.R.drawable.ic_delete)
                .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        SingletonGestorHospital.getInstance(getApplicationContext()).removerMarcacaoAPI(marcacao,getApplicationContext());
                        setResult(RESULT_OK);
                        finish();
                    }
                })
                .setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        // não vai fazer nada
                    }
                }).show();
    }
}
