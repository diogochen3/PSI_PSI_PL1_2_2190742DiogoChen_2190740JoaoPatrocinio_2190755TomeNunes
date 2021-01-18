package amsi.dei.estg.ipleiria.healthschedule.views;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.adaptors.AdapterMarcacao;
import amsi.dei.estg.ipleiria.healthschedule.listeners.EspecialidadeListener;
import amsi.dei.estg.ipleiria.healthschedule.listeners.MarcacoesListener;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.app.TimePickerDialog;
import android.os.Build;
import android.os.Bundle;
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

public class MarcacaoActivity extends AppCompatActivity  implements MarcacoesListener, EspecialidadeListener {

    public static final String ID = "ID";
    private Marcacao marcacao;



    private Spinner spMedico, spEspecialidade;

    private ArrayAdapter arrayAdapter;
    private ArrayList<String> especialidade;
    private ArrayList<String> medico;

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

        FloatingActionButton fab = findViewById(R.id.fab);
        spEspecialidade = findViewById(R.id.spEspecialidade);
        spMedico = findViewById(R.id.spMedico);
        tpTime = findViewById(R.id.tpTime);
        cvDate = findViewById(R.id.cvDate);
        tpTime.setIs24HourView(true);




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
                        marcacao = new Marcacao(0,5,2,6,date,time,0/*,Integer.parseInt(etAno.getText().toString())*/);
                        SingletonGestorHospital.getInstance(getApplicationContext()).adicionarMarcacaoAPI(marcacao,getApplicationContext());
                    }else return;
                    // setResult(RESULT_OK);
                    //finish();
                }

            }
        });




        spMedico.setOnItemSelectedListener(new OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                if (position== 0)
                {
                    arrayAdapter=new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, medico);
                    //spMedico.setAdapter(medico);
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });



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
        especialidade = SingletonGestorHospital.getInstance(getApplicationContext()).getallEspecialidadeNomeBD();
        arrayAdapter=new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, especialidade);
        spEspecialidade.setAdapter(arrayAdapter);
        //spEspecialidade.setAdapter(new Adapter(getApplicationContext(),especialidades));
    }

}