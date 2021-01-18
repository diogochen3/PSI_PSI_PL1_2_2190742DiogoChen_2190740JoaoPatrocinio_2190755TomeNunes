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
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.CalendarView;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TimePicker;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;
import java.util.Calendar;

public class MarcacaoActivity extends AppCompatActivity  implements MarcacoesListener, EspecialidadeListener {

    public static final String ID = "ID";
    private Marcacao marcacao;

    private ArrayList<Profile> medico;

    private Spinner spMedico, spEspecialidade;
    private ArrayAdapter arrayAdapter;
    private ArrayList<String> especialidade;

    private EditText etTime;
    private TimePickerDialog timePickerDialog;
    private Calendar calendar;
    private CalendarView cvDate;
    private int currentHour;
    private int currentMinute;
    private String date;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_marcacao);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        final int id = getIntent().getIntExtra(ID,0);
        marcacao = SingletonGestorHospital.getInstance(getApplicationContext()).getMarcacao(id);



        SingletonGestorHospital.getInstance(getApplicationContext()).setMarcacaoListener(this);

        FloatingActionButton fab = findViewById(R.id.fab);
        spEspecialidade = findViewById(R.id.spEspecialidade);
        spMedico = findViewById(R.id.spMedico);
        etTime = findViewById(R.id.etTime);
        cvDate = findViewById(R.id.cvDate);


        if (marcacao != null){
           // setTitle("Detalhes"+livro.getTitulo());
            carregarDetalhesMarcacao();
            fab.setImageResource(R.drawable.ic_action_guardar);
        }else{
            setTitle("Marcar");
            fab.setImageResource(R.drawable.ic_action_adicionar);
            arrayAdapter=new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, especialidade);
            spEspecialidade.setAdapter(arrayAdapter);

        }


        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(HospitalJsonParser.isConnectionInternet(getApplicationContext())){
                    if (marcacao!=null){
                        marcacao.setDate(date);
                        marcacao.setTempo(etTime.getText().toString());

                        SingletonGestorHospital.getInstance(getApplicationContext()).editarMarcacaoAPI(marcacao,getApplicationContext());
                    }
                    else
                    if (validarMarcaco()==true){
                        marcacao = new Marcacao(0,5,2,6,date,etTime.getText().toString(),0/*,Integer.parseInt(etAno.getText().toString())*/);
                        SingletonGestorHospital.getInstance(getApplicationContext()).adicionarMarcacaoAPI(marcacao,getApplicationContext());
                    }else return;
                    // setResult(RESULT_OK);
                    //finish();
                }

            }
        });

        cvDate.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            @Override
            public void onSelectedDayChange(@NonNull CalendarView calendarView, int i, int i1, int i2) {
                date = i + "/"+ i1+ "/"+i2;
            }
        });



        spMedico.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long id) {
                if (position== 0)
                {
                    arrayAdapter=new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, medico);
                }
                //spMedico.setAdapter(medico);
            }
        });






        etTime.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                calendar = Calendar.getInstance();
                currentHour = calendar.get(Calendar.HOUR_OF_DAY);
                currentMinute = calendar.get(Calendar.MINUTE);

                timePickerDialog = new TimePickerDialog(getApplicationContext(), new TimePickerDialog.OnTimeSetListener() {
                    @Override
                    public void onTimeSet(TimePicker timePicker, int hourOfDay, int minute) {
                        etTime.setText(hourOfDay +":"+ minute+ ":00");
                    }

                },currentHour,currentMinute,true);

                timePickerDialog.show();
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
     //   spEspecialidade.setAdapter(new Adapter(getApplicationContext(),especialidades));
    }
}