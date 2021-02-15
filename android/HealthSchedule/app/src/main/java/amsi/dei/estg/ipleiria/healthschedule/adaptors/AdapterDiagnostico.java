package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Diagnostico;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;

public class AdapterDiagnostico extends BaseAdapter {


    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Diagnostico> diagnosticos;
    private ArrayList<Profile> profiles;

    public AdapterDiagnostico(Context context, ArrayList<Diagnostico> diagnosticos, ArrayList<Profile> profiles) {
        this.context = context;
        this.diagnosticos = diagnosticos;
        this.profiles = profiles;
    }

    @Override
    public int getCount() {
        return diagnosticos.size();
    }

    @Override
    public Object getItem(int i) {
        return diagnosticos.get(i);
    }

    @Override
    public long getItemId(int i) {
        return diagnosticos.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view == null)
            view = inflater.inflate(R.layout.item_lista_diagnostico, null);

        //otimização
        ViewHolderLista viewHolderLista = (ViewHolderLista) view.getTag();
        if (viewHolderLista == null) {
            viewHolderLista = new ViewHolderLista(view);
            view.setTag(viewHolderLista);
        }
        viewHolderLista.update(diagnosticos.get(i));

        return view;
    }

    private class ViewHolderLista {
        private TextView txtSituacao, txtDescricao, txtDate, txtMedicoDiagnostico;
        // private ImageView imgCapa;

        public ViewHolderLista(View view) {
            txtSituacao = view.findViewById(R.id.txtSituacao);
            txtDescricao = view.findViewById(R.id.txtDescricao);
            txtDate = view.findViewById(R.id.txtdataDiagnostico);
            txtMedicoDiagnostico = view.findViewById(R.id.txtMedicoDiagnostico);
        }

        public void update(Diagnostico diagnostico) {
            for (Profile p: profiles) {
                if (diagnostico.getId_medico() == p.getId())
                    txtMedicoDiagnostico.setText(p.getFirst_name() +" "+ p.getLast_name());
            }
            txtDescricao.setText(diagnostico.getDescricao());
            txtSituacao.setText(diagnostico.getSituacao());
            txtDate.setText(diagnostico.getDate());
        }

    }
}
