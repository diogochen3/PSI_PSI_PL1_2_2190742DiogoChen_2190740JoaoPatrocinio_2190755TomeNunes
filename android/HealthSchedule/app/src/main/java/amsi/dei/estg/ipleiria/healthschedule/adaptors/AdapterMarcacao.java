package amsi.dei.estg.ipleiria.healthschedule.adaptors;

import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.media.Image;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import amsi.dei.estg.ipleiria.healthschedule.R;
import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;
import androidx.cardview.widget.CardView;

import java.util.ArrayList;

public class AdapterMarcacao extends BaseAdapter {

    public static ArrayList<Marcacao> marcacoeslista;
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Marcacao> marcacoes;
    private ArrayList<Profile> medico;



    public AdapterMarcacao(Context context, ArrayList<Marcacao> marcacoes, ArrayList<Profile> medico) {
        this.context = context;
        this.marcacoes = marcacoes;
        this.medico = medico;
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
        private CardView marcacao_card;
        private ImageView aceite,naoaceite,poraceitar;

        public ViewHolderLista(View view) {
            aceite = view.findViewById(R.id.aceite);
            naoaceite = view.findViewById(R.id.naoaceite);
            poraceitar = view.findViewById(R.id.poraceitar);
            marcacao_card = view.findViewById(R.id.marcacao_card);
            txtDataMarcacao = view.findViewById(R.id.txtDataMarcacao);
            txtHoraMarcacao = view.findViewById(R.id.txtHoraMarcacao);
            txtMedicoMarcacao = view.findViewById(R.id.txtMedicoMarcacao);

        }

        public void update(Marcacao marcacao) {
            txtDataMarcacao.setText(marcacao.getDate());
            txtHoraMarcacao.setText(marcacao.getTempo());
            for (Profile p: medico) {
                if (marcacao.getId_Medico() == p.getId())
                    txtMedicoMarcacao.setText(p.getFirst_name() +" "+ p.getLast_name());
            }


            if(marcacao.getAceitar()== 0){
                naoaceite.setVisibility(View.GONE);
                poraceitar.setVisibility(View.VISIBLE);
                aceite.setVisibility(View.GONE);
            }else if(marcacao.getAceitar()== 1){
                aceite.setVisibility(View.VISIBLE);
                naoaceite.setVisibility(View.GONE);
                poraceitar.setVisibility(View.GONE);
            }else{
                aceite.setVisibility(View.GONE);
                naoaceite.setVisibility(View.VISIBLE);
                poraceitar.setVisibility(View.GONE);
            }



        }


    }

}






