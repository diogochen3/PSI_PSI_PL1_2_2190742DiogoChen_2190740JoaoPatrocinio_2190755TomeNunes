package amsi.dei.estg.ipleiria.healthschedule.views;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.drawable.LayerDrawable;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.listeners.HospitalLoginListener;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;
import androidx.appcompat.app.AppCompatActivity;

public class LoginActivity extends AppCompatActivity  implements HospitalLoginListener {

    private EditText etEmail;
    private EditText etPass;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle(getString(R.string.Title_login));
        etEmail = findViewById(R.id.etEmail);
        etPass = findViewById(R.id.etPassword);


        SingletonGestorHospital.getInstance(getApplicationContext()).setHospitalLoginListener(this);
        SharedPreferences sharedPreferences = getSharedPreferences(MenuMainActivity.USER, Context.MODE_PRIVATE);

        if (sharedPreferences.getString(MenuMainActivity.EMAIL, "sem email").equals("sem email"))
        {

        }else
        {
            Intent intent = new Intent(this, MenuMainActivity.class);
            startActivity(intent);
            finish();
        }

    }


    public void onClickLogin(View view) {
        String email = etEmail.getText().toString();
        String pass = etPass.getText().toString();

        if (!isEmailvalido(email)){
            etEmail.setError("Email invalido");
            return;
        }

        if (!isPasswordvalida(pass)){
            etPass.setError("password invalido");
            return;
        }

       /* Intent intent = new Intent(this, MenuMainActivity.class);
        intent.putExtra(MenuMainActivity.EMAIL,email);
        startActivity(intent);
        finish();*/
       // Toast.makeText(getApplicationContext(),"Resposta"+ sharedPreferences.contains("EMAIL"),Toast.LENGTH_LONG).show();
       /* if (sharedPreferences.contains(email))
        {

        }*/

        if(!HospitalJsonParser.isConnectionInternet(getApplicationContext())){
            Toast.makeText(getApplicationContext(),"É preciso net",Toast.LENGTH_SHORT);
        }else
            SingletonGestorHospital.getInstance(getApplicationContext()).loginAPI(email, pass,getApplicationContext());

    }

    private boolean isEmailvalido(String email){
        if (email == null) {
            return false;
        }
        //validar se a string é do tipo email (ver classe Pattern(
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    private boolean isPasswordvalida(String password){
        if (password == null){
            return false;
        }
        //Validar se a string tem >=4 caracter
        return password.length() >= 4;
    }



    @Override
    public void onValidateLogin(String email,int id) {
        if (id != 0)
        {
            SharedPreferences sharedPreferences = getSharedPreferences(MenuMainActivity.USER, Context.MODE_PRIVATE);
            SharedPreferences.Editor editor =  sharedPreferences.edit();
            editor.putString(MenuMainActivity.EMAIL, email);
            editor.putInt(MenuMainActivity.ID, id);
            editor.apply();
            Intent intent = new Intent(this, MenuMainActivity.class);
            ///  intent.putExtra(MenuMainActivity.EMAIL,email);
            startActivity(intent);
            finish();
        }else
            Toast.makeText(getApplicationContext(),"Login invalido",Toast.LENGTH_SHORT);
    }

}