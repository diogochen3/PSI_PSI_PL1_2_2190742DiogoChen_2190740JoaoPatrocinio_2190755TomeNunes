[1mdiff --git a/android/HealthSchedule/.idea/codeStyles/Project.xml b/android/HealthSchedule/.idea/codeStyles/Project.xml[m
[1mindex 0d15693..663459a 100644[m
[1m--- a/android/HealthSchedule/.idea/codeStyles/Project.xml[m
[1m+++ b/android/HealthSchedule/.idea/codeStyles/Project.xml[m
[36m@@ -3,18 +3,9 @@[m
     <JetCodeStyleSettings>[m
       <option name="PACKAGES_TO_USE_STAR_IMPORTS">[m
         <value>[m
[31m-          <package name="java.util" alias="false" withSubpackages="false" />[m
[31m-          <package name="kotlinx.android.synthetic" alias="false" withSubpackages="true" />[m
[31m-          <package name="io.ktor" alias="false" withSubpackages="true" />[m
[31m-        </value>[m
[31m-      </option>[m
[31m-      <option name="PACKAGES_IMPORT_LAYOUT">[m
[31m-        <value>[m
[31m-          <package name="" alias="false" withSubpackages="true" />[m
[31m-          <package name="java" alias="false" withSubpackages="true" />[m
[31m-          <package name="javax" alias="false" withSubpackages="true" />[m
[31m-          <package name="kotlin" alias="false" withSubpackages="true" />[m
[31m-          <package name="" alias="true" withSubpackages="true" />[m
[32m+[m[32m          <package name="java.util" withSubpackages="false" static="false" />[m
[32m+[m[32m          <package name="kotlinx.android.synthetic" withSubpackages="true" static="false" />[m
[32m+[m[32m          <package name="io.ktor" withSubpackages="true" static="false" />[m
         </value>[m
       </option>[m
     </JetCodeStyleSettings>[m
[1mdiff --git a/android/HealthSchedule/app/build.gradle b/android/HealthSchedule/app/build.gradle[m
[1mindex 148c379..a5c277e 100644[m
[1m--- a/android/HealthSchedule/app/build.gradle[m
[1m+++ b/android/HealthSchedule/app/build.gradle[m
[36m@@ -24,10 +24,12 @@[m [mandroid {[m
 dependencies {[m
     implementation fileTree(dir: "libs", include: ["*.jar"])[m
     implementation 'com.android.volley:volley:1.1.1'[m
[32m+[m[32m    implementation 'com.google.android.material:material:1.2.1'[m
     implementation 'com.github.bumptech.glide:glide:4.10.0'[m
     implementation 'androidx.appcompat:appcompat:1.2.0'[m
     implementation 'androidx.constraintlayout:constraintlayout:2.0.4'[m
     implementation 'androidx.recyclerview:recyclerview:1.1.0'[m
[32m+[m[32m    implementation 'androidx.legacy:legacy-support-v4:1.0.0'[m
     testImplementation 'junit:junit:4.12'[m
     androidTestImplementation 'androidx.test.ext:junit:1.1.2'[m
     androidTestImplementation 'androidx.test.espresso:espresso-core:3.3.0'[m
[1mdiff --git a/android/HealthSchedule/app/src/main/AndroidManifest.xml b/android/HealthSchedule/app/src/main/AndroidManifest.xml[m
[1mindex 05d1b66..8140806 100644[m
[1m--- a/android/HealthSchedule/app/src/main/AndroidManifest.xml[m
[1m+++ b/android/HealthSchedule/app/src/main/AndroidManifest.xml[m
[36m@@ -2,21 +2,21 @@[m
 <manifest xmlns:android="http://schemas.android.com/apk/res/android"[m
     package="amsi.dei.estg.ipleiria.healthschedule">[m
 [m
[31m-    <uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" />[m
[31m-    <uses-permission android:name="android.permission.INTERNET" />[m
     <application[m
[31m-        android:usesCleartextTraffic="true"[m
         android:allowBackup="true"[m
         android:icon="@mipmap/ic_launcher"[m
         android:label="@string/app_name"[m
         android:roundIcon="@mipmap/ic_launcher_round"[m
         android:supportsRtl="true"[m
[31m-        android:theme="@style/AppTheme">[m
[32m+[m[32m        android:theme="@style/AppTheme"[m
[32m+[m[32m        android:usesCleartextTraffic="true">[m
[32m+[m[32m        <activity android:name=".views.MenuMainActivity"[m
[32m+[m[32m            android:launchMode="singleTop"[m
[32m+[m[32m            android:screenOrientation="portrait"[m
[32m+[m[32m            android:theme="@style/AppTheme.NoActionBar" />[m
         <activity android:name=".views.ListaMedicosActivity" />[m
[31m-        <activity android:name=".views.ContatoActivity" />[m
         <activity android:name=".views.PerfilActivity" />[m
         <activity android:name=".views.ListaMedicamentosActivity" />[m
[31m-        <activity android:name=".views.AgendaActivity" />[m
         <activity android:name=".views.MarcacaoActivity" />[m
         <activity android:name=".views.LoginActivity">[m
             <intent-filter>[m
[36m@@ -25,13 +25,9 @@[m
                 <category android:name="android.intent.category.LAUNCHER" />[m
             </intent-filter>[m
         </activity>[m
[31m-        <activity android:name=".MainActivity">[m
[31m-            <intent-filter>[m
[31m-                <action android:name="android.intent.action.MAIN" />[m
[31m-[m
[31m-                <category android:name="android.intent.category.LAUNCHER" />[m
[31m-            </intent-filter>[m
[31m-        </activity>[m
     </application>[m
[32m+[m[32m    <uses-permission android:name="android.permission.INTERNET" />[m
[32m+[m
[32m+[m[32m    <uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" />[m
 [m
 </manifest>[m
\ No newline at end of file[m
[1mdiff --git a/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/model/SingletonGestorHospital.java b/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/model/SingletonGestorHospital.java[m
[1mindex 7663bb9..59d66e1 100644[m
[1m--- a/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/model/SingletonGestorHospital.java[m
[1m+++ b/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/model/SingletonGestorHospital.java[m
[36m@@ -43,7 +43,7 @@[m [mpublic class SingletonGestorHospital {[m
     }[m
 [m
 [m
[31m-    public void loginAPI(final String email, final String pass, final Context applicationContext) {[m
[32m+[m[32m   /* public void loginAPI(final String email, final String pass, final Context applicationContext) {[m
 [m
         StringRequest req =new StringRequest(Request.Method.POST,[m
                     mUrlAPILogin, new Response.Listener<String>() {[m
[36m@@ -76,5 +76,7 @@[m [mpublic class SingletonGestorHospital {[m
 [m
             volleyQueue.add(req);[m
 [m
[31m-    }[m
[32m+[m[32m    }*/[m
[32m+[m
[32m+[m
 }[m
[1mdiff --git a/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/views/LoginActivity.java b/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/views/LoginActivity.java[m
[1mindex 148288d..d2adb13 100644[m
[1m--- a/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/views/LoginActivity.java[m
[1m+++ b/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/views/LoginActivity.java[m
[36m@@ -1,19 +1,21 @@[m
 package amsi.dei.estg.ipleiria.healthschedule.views;[m
 [m
[32m+[m[32mimport android.content.Intent;[m
[32m+[m[32mimport android.os.Bundle;[m
[32m+[m[32mimport android.util.Patterns;[m
[32m+[m[32mimport android.view.View;[m
[32m+[m[32mimport android.widget.EditText;[m
[32m+[m[32mimport android.widget.Toast;[m
[32m+[m
 import amsi.dei.estg.ipleiria.healthschedule.R;[m
 import amsi.dei.estg.ipleiria.healthschedule.listeners.HospitalLoginListener;[m
 import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;[m
 import amsi.dei.estg.ipleiria.healthschedule.utils.HospitalJsonParser;[m
 import androidx.appcompat.app.AppCompatActivity;[m
 [m
[31m-import android.os.Bundle;[m
[31m-import android.view.View;[m
[31m-import android.widget.EditText;[m
[31m-import android.widget.Toast;[m
[31m-[m
 public class LoginActivity extends AppCompatActivity  implements HospitalLoginListener {[m
 [m
[31m-    private EditText etNif;[m
[32m+[m[32m    private EditText etEmail;[m
     private EditText etPass;[m
 [m
     @Override[m
[36m@@ -22,7 +24,7 @@[m [mpublic class LoginActivity extends AppCompatActivity  implements HospitalLoginLi[m
         setContentView(R.layout.activity_login);[m
         setTitle(getString(R.string.Title_login));[m
 [m
[31m-        etNif = findViewById(R.id.etNIF);[m
[32m+[m[32m        etEmail = findViewById(R.id.etEmail);[m
         etPass = findViewById(R.id.etPassword);[m
 [m
 [m
[36m@@ -32,11 +34,11 @@[m [mpublic class LoginActivity extends AppCompatActivity  implements HospitalLoginLi[m
 [m
 [m
     public void onClickLogin(View view) {[m
[31m-        String email = etNif.getText().toString();[m
[32m+[m[32m        String email = etEmail.getText().toString();[m
         String pass = etPass.getText().toString();[m
 [m
[31m-        if (!isNifvalida(email)){[m
[31m-            etNif.setError("NIF invalido");[m
[32m+[m[32m        if (!isEmailvalido(email)){[m
[32m+[m[32m            etEmail.setError("Email invalido");[m
             return;[m
         }[m
 [m
[36m@@ -44,17 +46,24 @@[m [mpublic class LoginActivity extends AppCompatActivity  implements HospitalLoginLi[m
             etPass.setError("password invalido");[m
             return;[m
         }[m
[31m-        if(HospitalJsonParser.isConnectionInternet(getApplicationContext())){[m
[32m+[m[32m        Intent intent = new Intent(this, MenuMainActivity.class);[m
[32m+[m[32m        ///  intent.putExtra(MenuMainActivity.EMAIL,email);[m
[32m+[m[32m        startActivity(intent);[m
[32m+[m[32m        finish();[m
[32m+[m
[32m+[m[32m     /*   if(HospitalJsonParser.isConnectionInternet(getApplicationContext())){[m
             Toast.makeText(getApplicationContext(),"É preciso net",Toast.LENGTH_SHORT);[m
         }else[m
             SingletonGestorHospital.getInstance(getApplicationContext()).loginAPI(email, pass,getApplicationContext());[m
[32m+[m[32m        */[m
     }[m
[31m-    private boolean isNifvalida(String nif){[m
[31m-        if (nif == null){[m
[32m+[m
[32m+[m[32m    private boolean isEmailvalido(String email){[m
[32m+[m[32m        if (email == null) {[m
             return false;[m
         }[m
[31m-        //Validar se a string tem >=4 caracter[m
[31m-        return nif.length() == 9;[m
[32m+[m[32m        //validar se a string é do tipo email (ver classe Pattern([m
[32m+[m[32m        return Patterns.EMAIL_ADDRESS.matcher(email).matches();[m
     }[m
 [m
     private boolean isPasswordvalida(String password){[m
[1mdiff --git a/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/views/MenuMainActivity.java b/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/views/MenuMainActivity.java[m
[1mindex 7bfe940..43473fb 100644[m
[1m--- a/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/views/MenuMainActivity.java[m
[1m+++ b/android/HealthSchedule/app/src/main/java/amsi/dei/estg/ipleiria/healthschedule/views/MenuMainActivity.java[m
[36m@@ -1,14 +1,117 @@[m
 package amsi.dei.estg.ipleiria.healthschedule.views;[m
 [m
[32m+[m[32mimport amsi.dei.estg.ipleiria.healthschedule.R;[m
[32m+[m[32mimport androidx.annotation.NonNull;[m
[32m+[m[32mimport androidx.appcompat.app.ActionBarDrawerToggle;[m
 import androidx.appcompat.app.AppCompatActivity;[m
[32m+[m[32mimport androidx.appcompat.widget.Toolbar;[m
[32m+[m[32mimport androidx.core.view.GravityCompat;[m
[32m+[m[32mimport androidx.drawerlayout.widget.DrawerLayout;[m
[32m+[m[32mimport androidx.fragment.app.Fragment;[m
[32m+[m[32mimport androidx.fragment.app.FragmentManager;[m
 [m
[32m+[m[32mimport android.content.Context;[m
[32m+[m[32mimport android.content.SharedPreferences;[m
 import android.os.Bundle;[m
[32m+[m[32mimport android.view.MenuItem;[m
[32m+[m[32mimport android.view.View;[m
[32m+[m[32mimport android.widget.TextView;[m
 [m
[31m-public class MenuMainActivity extends AppCompatActivity {[m
[32m+[m[32mimport com.google.android.material.navigation.NavigationView;[m
[32m+[m
[32m+[m[32mpublic class MenuMainActivity extends AppCompatActivity  implements NavigationView.OnNavigationItemSelectedListener{[m
[32m+[m
[32m+[m[32m    private static final String EMAIL = "email";[m
[32m+[m
[32m+[m[32m    private String email="";[m
[32m+[m[32m    private NavigationView navigationView;[m
[32m+[m[32m    private DrawerLayout drawer;[m
[32m+[m
[32m+[m[32m    private FragmentManager fragmentManager;[m
 [m
     @Override[m
     protected void onCreate(Bundle savedInstanceState) {[m
         super.onCreate(savedInstanceState);[m
         setContentView(R.layout.activity_menu_main);[m
[32m+[m
[32m+[m[32m        email = getIntent().getStringExtra(EMAIL);[m
[32m+[m
[32m+[m[32m        Toolbar toolbar = findViewById(R.id.toolbar);[m
[32m+[m[32m        setSupportActionBar(toolbar);[m
[32m+[m[32m        navigationView = findViewById(R.id.nav_view);[m
[32m+[m[32m        drawer = findViewById(R.id.drawer_layout);[m
[32m+[m[32m        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer,[m
[32m+[m[32m                toolbar, R.string.ndOpen, R.string.ndClose);[m
[32m+[m[32m        toggle.syncState();[m
[32m+[m[32m        drawer.addDrawerListener(toggle);[m
[32m+[m
[32m+[m[32m        fragmentManager=getSupportFragmentManager();[m
[32m+[m
[32m+[m
[32m+[m[32m        carregarCabecalho();[m
[32m+[m
[32m+[m
[32m+[m
[32m+[m[32m        navigationView.setNavigationItemSelectedListener(this);[m
[32m+[m
[32m+[m[32m        carregarFragmentoInicial();[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    private void carregarFragmentoInicial() {[m
[32m+[m[32m        navigationView.setCheckedItem(R.id.nav_perfil);[m
[32m+[m[32m        /*Fragment fragment = new ListaLivrosFragment();[m
[32m+[m[32m        setTitle(R.string.titleEstatico);[m
[32m+[m[32m        fragmentManager.beginTransaction().replace(R.id.contentFragment,fragment).commit();*/[m
[32m+[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m
[32m+[m[32m    private void carregarCabecalho() {[m
[32m+[m[32m        SharedPreferences sharedPreferences = getSharedPreferences(MenuMainActivity.EMAIL, Context.MODE_PRIVATE);[m
[32m+[m[32m        email = sharedPreferences.getString(EMAIL, "sem email");[m
[32m+[m[32m        View hview= navigationView.getHeaderView(0);[m
[32m+[m[32m        TextView tvEmail= findViewById(R.id.Email);[m
[32m+[m[32m        tvEmail.setText(email);[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    @Override[m
[32m+[m[32m    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {[m
[32m+[m[32m        Fragment fragment= null;[m
[32m+[m
[32m+[m[32m        switch (menuItem.getItemId()) {[m
[32m+[m[32m            case R.id.nav_perfil:[m
[32m+[m[32m               /* fragment=new ListaLivrosFragment();[m
[32m+[m[32m                setTitle(menuItem.getTitle());*/[m
[32m+[m[32m                //  System.out.println("-->Nav Estatico");[m
[32m+[m[32m                break;[m
[32m+[m[32m            case R.id.nav_consultas:[m
[32m+[m[32m             /*   fragment=new DinamicoFragment();[m
[32m+[m[32m                setTitle(menuItem.getTitle());*/[m
[32m+[m[32m                // System.out.println("-->Nav Dinamico");[m
[32m+[m[32m                break;[m
[32m+[m[32m            case R.id.nav_marcacao:[m
[32m+[m[32m               /* fragment=new DinamicoFragment();[m
[32m+[m[32m                setTitle(menuItem.getTitle());*/[m
[32m+[m[32m                // System.out.println("-->Nav Dinamico");[m
[32m+[m[32m                break;[m
[32m+[m[32m            case R.id.nav_medicos:[m
[32m+[m[32m               /* fragment=new DinamicoFragment();[m
[32m+[m[32m                setTitle(menuItem.getTitle());*/[m
[32m+[m[32m                // System.out.println("-->Nav Dinamico");[m
[32m+[m[32m                break;[m
[32m+[m[32m            case R.id.nav_contato:[m
[32m+[m[32m//                fragment=new DinamicoFragment();[m
[32m+[m[32m//                setTitle(menuItem.getTitle());[m
[3