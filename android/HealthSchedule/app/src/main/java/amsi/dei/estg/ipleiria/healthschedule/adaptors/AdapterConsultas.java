package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import java.util.ArrayList;

public class AdapterConsultas extends BaseAdapter {

    //public AdapterConsultas(){}

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Marcacao> marcacoes;

    public AdapterConsultas(Context context, ArrayList<Marcacao> marcacoes) {
        this.context = context;
        this.marcacoes = marcacoes;
    }

    @Override
    public int getCount() {
        return marcacoes.size();
    }

    @Override
    public Object getItem(int i) {
        return marcacoes.get(i);
    }

    @Override
    public long getItemId(int i) {
        return marcacoes.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view == null)
            view = inflater.inflate(R.layout.item_lista_marcacao, null);

        //otimização
        ViewHolderLista viewHolderLista = (ViewHolderLista) view.getTag();
        if (viewHolderLista == null) {
            viewHolderLista = new ViewHolderLista(view);
            view.setTag(viewHolderLista);
        }
        viewHolderLista.update(marcacoes.get(i));

        return view;
    }

    private class ViewHolderLista {
        private TextView txtDataMarcacao, txtHoraMarcacao, txtEspecialidadeMarcacao, txtMedicoMarcacao, txtUtenteMarcacao;
        // private ImageView imgCapa;

        public ViewHolderLista(View view) {
            txtDataMarcacao = view.findViewById(R.id.txtDataMarcacao);
            txtHoraMarcacao = view.findViewById(R.id.txtHoraMarcacao);
            txtEspecialidadeMarcacao = view.findViewById(R.id.txtEspecialidadeMarcacao);
            txtMedicoMarcacao = view.findViewById(R.id.txtMedicoMarcacao);
            txtUtenteMarcacao = view.findViewById(R.id.txtUtenteMarcacao);

        }

        public void update(Marcacao marcacao) {
            txtDataMarcacao.setText(marcacao.getDate());
            txtHoraMarcacao.setText(marcacao.getTempo());
            txtEspecialidadeMarcacao.setText(marcacao.getId_especialidade());
            txtMedicoMarcacao.setText(marcacao.getId_Medico());
            txtUtenteMarcacao.setText(marcacao.getId_Utente());
        }

    }
}
