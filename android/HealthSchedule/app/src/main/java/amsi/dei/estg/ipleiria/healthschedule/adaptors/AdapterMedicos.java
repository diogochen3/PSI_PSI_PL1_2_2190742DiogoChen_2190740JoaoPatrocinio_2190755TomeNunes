package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.ListView;
import android.widget.TextView;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Especialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.MedicoEspecialidade;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import androidx.recyclerview.widget.RecyclerView;

public class AdapterMedicos extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Profile> profiles;
    private ArrayList<Especialidade> especialidades;
    private ArrayList<MedicoEspecialidade> medicoEspecialidades;

    public AdapterMedicos(Context context, ArrayList<Profile> profiles, ArrayList<Especialidade> especialidades, ArrayList<MedicoEspecialidade> medicoEspecialidades) {
        this.context = context;
        this.profiles = profiles;
        this.especialidades = especialidades;
        this.medicoEspecialidades = medicoEspecialidades;
    }

    @Override
    public int getCount() {
        return profiles.size();
    }

    @Override
    public Object getItem(int i) {
        return profiles.get(i);
    }

    @Override
    public long getItemId(int i) {
        return profiles.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view == null)
            view = inflater.inflate(R.layout.item_spinner_medicos, null);

        //otimização
        ViewHolderLista viewHolderLista = (ViewHolderLista) view.getTag();
        if (viewHolderLista == null) {
            viewHolderLista = new ViewHolderLista(view);
            view.setTag(viewHolderLista);
        }
        viewHolderLista.update(profiles.get(i));

        return view;
    }
    private class ViewHolderLista {
        private TextView txtNomeMedico, txtEmail, txtNumeroTL;
        private ListView lvEspecialidade;
        // private ImageView imgCapa;

        public ViewHolderLista(View view) {
            txtNomeMedico = view.findViewById(R.id.txtNomeMedico);
            txtEmail = view.findViewById(R.id.txtEmail);
            txtNumeroTL = view.findViewById(R.id.txtNumeroTL);
            lvEspecialidade = view.findViewById(R.id.lvEspecialidade);
        }

        public void update(Profile profile) {
            txtNomeMedico.setText(profile.getFirst_name() + " " + profile.getLast_name());
            ArrayList<String> nomeEspecialidade = new ArrayList<>();
            txtEmail.setText(profile.getEmail());
            txtNumeroTL.setText(profile.getPhone_number());

            for (Especialidade e: especialidades) {
                for (MedicoEspecialidade me: medicoEspecialidades) {
                    if (profile.getId() == me.getId_Medico() && me.getId_Especialidade() == e.getId())
                        nomeEspecialidade.add(e.getName());
                }
            }

            ArrayAdapter<String> adapterEspecialidade = new ArrayAdapter<>(context, android.R.layout.simple_list_item_1, nomeEspecialidade);
            lvEspecialidade.setAdapter(adapterEspecialidade);
        }

    }
}
