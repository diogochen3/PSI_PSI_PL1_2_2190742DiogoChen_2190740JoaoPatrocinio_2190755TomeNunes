package amsi.dei.estg.ipleiria.healthschedule.views;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;
import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.navigation.NavigationView;

public class MenuMainActivity extends AppCompatActivity  implements NavigationView.OnNavigationItemSelectedListener{

    private static final String EMAIL = "email";

    private String email="";
    private NavigationView navigationView;
    private DrawerLayout drawer;

    private FragmentManager fragmentManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_main);

        email = getIntent().getStringExtra(EMAIL);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        navigationView = findViewById(R.id.nav_view);
        drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer,
                toolbar, R.string.ndOpen, R.string.ndClose);
        toggle.syncState();
        drawer.addDrawerListener(toggle);

        fragmentManager=getSupportFragmentManager();


        carregarCabecalho();
        SingletonGestorHospital.getInstance(getApplicationContext()).getAllProfileAPI(getApplicationContext());


        navigationView.setNavigationItemSelectedListener(this);

        carregarFragmentoInicial();
    }

    private void carregarFragmentoInicial() {
        navigationView.setCheckedItem(R.id.nav_perfil);
        /*Fragment fragment = new ListaLivrosFragment();
        setTitle(R.string.titleEstatico);
        fragmentManager.beginTransaction().replace(R.id.contentFragment,fragment).commit();*/

    }


    private void carregarCabecalho() {
        SharedPreferences sharedPreferences = getSharedPreferences(MenuMainActivity.EMAIL, Context.MODE_PRIVATE);
        email = sharedPreferences.getString(EMAIL, "sem email");
       // View hview= navigationView.getHeaderView(0);
        TextView tvEmail= findViewById(R.id.Email);

    }


    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
        Fragment fragment= null;

        switch (menuItem.getItemId()) {
            case R.id.nav_perfil:
                fragment=new PerfilFragment();
                setTitle(menuItem.getTitle());
                break;
            case R.id.nav_diagnosticos:

                fragment=new ListaDiagnosticosFragment();
                setTitle(menuItem.getTitle());


                break;
            case R.id.nav_marcacao:
             fragment=new AgendaFragment();
                setTitle(menuItem.getTitle());
                break;
            case R.id.nav_medicos:
               /* fragment=new DinamicoFragment();
                setTitle(menuItem.getTitle());*/
                // System.out.println("-->Nav Dinamico");
                break;
            case R.id.nav_contato:
//                fragment=new DinamicoFragment();
//                setTitle(menuItem.getTitle());
                // System.out.println("-->Nav Dinamico");
                break;
            case R.id.nav_receitas:
                 fragment=new ListaReceitasFragment();
                 setTitle(menuItem.getTitle());
                 // System.out.println("-->Nav Dinamico");
                break;
                default:
//                fragment=new EstaticoFragment();
//                setTitle(menuItem.getTitle());
                // System.out.println("-->Nav Estatico");
        }
        if(fragment!= null)
            fragmentManager.beginTransaction().replace(R.id.contentFragment,fragment).commit();
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }


}