package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ListView;
import android.widget.TextView;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Medicamento;
import amsi.dei.estg.ipleiria.healthschedule.model.Receita;
import amsi.dei.estg.ipleiria.healthschedule.model.ReceitaMedicamento;
import amsi.dei.estg.ipleiria.healthschedule.model.SingletonGestorHospital;

public class AdapterMedicamento extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<ReceitaMedicamento> receitaMedicamentos;

    public AdapterMedicamento(Context context, ArrayList<ReceitaMedicamento> receitaMedicamentos) {
        this.context = context;
        this.receitaMedicamentos = receitaMedicamentos;
    }
    @Override
    public int getCount() {
        return receitaMedicamentos.size();
    }

    @Override
    public Object getItem(int i) {
        return receitaMedicamentos.get(i);
    }

    @Override
    public long getItemId(int i) {
        return receitaMedicamentos.get(i).getId_receita();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if (inflater == null)
            inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        if (view == null)
            view = inflater.inflate(R.layout.item_lista_medicamentos, null);

        //otimização
        ViewHolderLista viewHolderLista = (ViewHolderLista) view.getTag();
        if (viewHolderLista == null) {
            viewHolderLista = new ViewHolderLista(view);
            view.setTag(viewHolderLista);
        }
        viewHolderLista.update(receitaMedicamentos.get(i));

        return view;
    }

    private class ViewHolderLista {
        private TextView txtNomeMedicamento, txtDosagem, txtForma_Farmaceuta, txtEmbalagem, txtQuantidade, txtPosologia;

        public ViewHolderLista(View view) {
            txtNomeMedicamento = view.findViewById(R.id.txtNomeMedicamento);
            txtDosagem = view.findViewById(R.id.txtDosagem);
            txtForma_Farmaceuta = view.findViewById(R.id.txtForma_farmaceuta);
            txtEmbalagem = view.findViewById(R.id.txtEmbalagem);
            txtQuantidade = view.findViewById(R.id.txtQuantidade);
            txtPosologia = view.findViewById(R.id.txtPosologia);
        }

        public void update(ReceitaMedicamento receitaMedicamento) {

            Medicamento medicamentos = SingletonGestorHospital.getInstance(context).getMedicamentos(receitaMedicamento.getId_medicamento());
            if (medicamentos != null)
            {
                txtNomeMedicamento.setText(medicamentos.getNome_medicamento());
                txtDosagem.setText(medicamentos.getDosagem());
                txtForma_Farmaceuta.setText(medicamentos.getForma_farmaceuta());
                txtEmbalagem.setText(medicamentos.getEmbalagem());
                txtQuantidade.setText(receitaMedicamento.getQuantidade()+"");
                txtPosologia.setText(receitaMedicamento.getPosologia());
            }

        }

    }
}
