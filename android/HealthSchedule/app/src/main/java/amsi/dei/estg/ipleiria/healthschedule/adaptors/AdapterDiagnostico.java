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

public class AdapterDiagnostico extends BaseAdapter {


    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Diagnostico> diagnosticos;

    public AdapterDiagnostico(Context context, ArrayList<Diagnostico> diagnosticos) {
        this.context = context;
        this.diagnosticos = diagnosticos;
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
        private TextView txtSituacao, txtDescricao;
        // private ImageView imgCapa;

        public ViewHolderLista(View view) {
            txtSituacao = view.findViewById(R.id.txtSituacao);
            txtDescricao = view.findViewById(R.id.txtDescricao);

        }

        public void update(Diagnostico diagnostico) {
            txtDescricao.setText(diagnostico.getDescricao());
            txtSituacao.setText(diagnostico.getSituacao());

        }

    }
}
