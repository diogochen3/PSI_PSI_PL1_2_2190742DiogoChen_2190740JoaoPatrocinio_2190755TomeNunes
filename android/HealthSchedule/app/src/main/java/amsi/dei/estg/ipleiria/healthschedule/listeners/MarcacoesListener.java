package amsi.dei.estg.ipleiria.healthschedule.listeners;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;

public interface MarcacoesListener {

    void onRefreshListaLivros(ArrayList<Marcacao> marcacoes);

    void onRefreshdetalhesLivros();

}
