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
import androidx.cardview.widget.CardView;

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

import java.sql.Time;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class MarcacaoActivity extends AppCompatActivity  implements MarcacoesListener, EspecialidadeListener, MedicoEspecialidadeListener {

    public static final String ID = "ID";
    private static final String ID_USER = "ID_USER";
    private Marcacao marcacao;
    private int id_especialidade;
    private int id_medico;
    private ArrayList<MedicoEspecialidade> medicoEspecialidades;
    private Spinner spMedico, spEspecialidade;
    private ArrayAdapter arrayAdapter;
    private ArrayList<Especialidade> especialidade;
    private ArrayList<Profile> medico;
    private TextView tvEspecialidade, tvMedico;
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
        final int id_user = getIntent().getIntExtra(ID_USER,0);
        marcacao = SingletonGestorHospital.getInstance(getApplicationContext()).getMarcacao(id);

        SingletonGestorHospital.getInstance(getApplicationContext()).setMedicoEspecialidadeListener(this);
        SingletonGestorHospital.getInstance(getApplicationContext()).setEspecialidadeListener(this);

        SingletonGestorHospital.getInstance(getApplicationContext()).setMarcacaoListener(this);

        SingletonGestorHospital.getInstance(getApplicationContext()).getAllMedicoEspecialidadeAPI(getApplicationContext());

        SingletonGestorHospital.getInstance(getApplicationContext()).getAllEspecialidadeAPI(getApplicationContext());

        FloatingActionButton fab = findViewById(R.id.fab);
        spEspecialidade = findViewById(R.id.spEspecialidade);
        spMedico = findViewById(R.id.spMedico);
        tpTime = findViewById(R.id.tpTime);
        cvDate = findViewById(R.id.cvDate);
        tvEspecialidade = findViewById(R.id.tvEspecialidade);
        tvMedico = findViewById(R.id.tvMedico);
        cvDate.setMinDate((new Date().getTime()));
        tpTime.setIs24HourView(true);

        Date currentTime = Calendar.getInstance().getTime();
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");
        date =  formatter.format(currentTime);


        cvDate.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            @Override
            public void onSelectedDayChange(@NonNull CalendarView calendarView, int i, int i1, int i2) {
                i1 = i1 + 1;
                String mes;
                if (i1 < 9)
                    mes = "0"+ i1;
                else
                    mes = ""+i1;
                date = i+"-" + mes + "-" +i2;
            }

        });


        if (marcacao != null){
            // setTitle("Detalhes"+livro.getTitulo());
            carregarDetalhesMarcacao();
            fab.setImageResource(R.drawable.ic_action_guardar);
        }else{
            tvMedico.setVisibility(View.GONE);
            tvEspecialidade.setVisibility(View.GONE);
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

                        marcacao.setDate(date);
                        marcacao.setTempo(time = validarHoras());
                        marcacao.setAceitar(0);
                        SingletonGestorHospital.getInstance(getApplicationContext()).editarMarcacaoAPI(marcacao,getApplicationContext());

                    }
                    else if (validarMarcaco()==true){
                        time = validarHoras();


                        marcacao = new Marcacao(0,id_especialidade,id_user,id_medico,date,time,0);
                        SingletonGestorHospital.getInstance(getApplicationContext()).adicionarMarcacaoAPI(marcacao,getApplicationContext());
                    }else return;
                    // setResult(RESULT_OK);
                    //finish();
                }

            }
        });




        spEspecialidade.setOnItemSelectedListener(new OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                medico = SingletonGestorHospital.getInstance(getApplicationContext()).getMedicos(id);
                spMedico.setAdapter(new AdapterNomeMedicos(getApplicationContext(),medico));
                id_especialidade = (int) id;
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }

        });


        spMedico.setOnItemSelectedListener(new OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int position, long id) {
                id_medico = (int) id;
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }

        });

    }

    private String validarHoras() {
        if (Build.VERSION.SDK_INT >= 23 ){
            hour = tpTime.getHour();
            minute = tpTime.getMinute();
        }
        else{
            hour = tpTime.getCurrentHour();
            minute = tpTime.getCurrentMinute();
        }
        String horas, min;
        if (hour < 9)
            horas = "0"+ hour;
        else
            horas = hour+"";
        if (minute < 9)
            min = "0"+ minute;
        else
            min = minute+"";

        return horas +":" +min+ ":00";
    }


    private void carregarDetalhesMarcacao() {
        spEspecialidade.setVisibility(View.GONE);
        spMedico.setVisibility(View.GONE);



        /*ArrayList<Especialidade> especialidades = new ArrayList<>();
        ArrayList<Profile> profiles = new ArrayList<>();
        especialidades = SingletonGestorHospital.getInstance(getApplicationContext()).getArrayEspecialidade(marcacao.getId_especialidade());
        spEspecialidade.setAdapter(new AdapterEspecialidade(getApplicationContext(),especialidades));
        profiles = SingletonGestorHospital.getInstance(getApplicationContext()).getArrayMedico(marcacao.getId_Medico());
        spMedico.setAdapter(new AdapterNomeMedicos(getApplicationContext(),profiles));*/

        tvMedico.setText(marcacao.getId_Medico()+"");



        /*spEspecialidade.setSelected(false);
        spEspecialidade.setEnabled(false);
        spMedico.setSelected(false);
        spMedico.setEnabled(false);*/

        SimpleDateFormat timeFormatter = new SimpleDateFormat("HH:mm:ss");
        Date tempo = null;
        try {
            tempo = timeFormatter.parse(marcacao.getTempo());
        } catch (ParseException e) {
            e.printStackTrace();
        }
        Calendar c = Calendar.getInstance();
        c.setTime(tempo);
        tpTime.setCurrentHour(c.get(Calendar.HOUR_OF_DAY));
        tpTime.setCurrentMinute(c.get(Calendar.MINUTE));



        String parts[] = marcacao.getDate().split("-");

        int day = Integer.parseInt(parts[2]);
        int month = Integer.parseInt(parts[1]);
        int year = Integer.parseInt(parts[0]);
        Calendar calendar = Calendar.getInstance();
        calendar.set(Calendar.YEAR, year);
        calendar.set(Calendar.MONTH, month);
        calendar.set(Calendar.DAY_OF_MONTH, day);

        long milliTime = calendar.getTimeInMillis();
        cvDate.setDate(milliTime, true, true);

    }

    private boolean validarMarcaco() {
        return true;
    }


    @Override
    public void onRefreshListaMarcacoes(ArrayList<Marcacao> marcacoes) {
        //Para listas
    }

    @Override
    public void onRefreshdetalhesMarcacoes() {
        setResult(RESULT_OK);
        finish();
    }



    @Override
    public void onRefreshListaEspecialidade(ArrayList<Especialidade> especialidades) {
        spEspecialidade.setAdapter(new AdapterEspecialidade(getApplicationContext(),especialidades));
      /*  if (marcacao!= null){
            Especialidade especialidade1 = SingletonGestorHospital.getInstance(getApplicationContext()).getEspecialidade(marcacao.getId_especialidade());
            tvEspecialidade.setText(especialidade1.getName());
            Profile profile = SingletonGestorHospital.getInstance(getApplicationContext()).getProfile(marcacao.getId_Medico());
            tvMedico.setText(profile.getFirst_name() +" "+profile.getLast_name());
        }*/
        especialidade = especialidades;
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
        builder.setTitle("Remover Marcação").setMessage("Pretende mesmo remover esta marcação?").setIcon(android.R.drawable.ic_delete)
                .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        SingletonGestorHospital.getInstance(getApplicationContext()).removerMarcacaoAPI(marcacao,getApplicationContext());
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
