using UnityEngine;
using System.Collections;

public class Unidade: MonoBehaviour {
	
	private bool selecionada;
	private bool clicada = false;

	public virtual void ActionCallback(Vector3 target){ }

	private void Update()
	{
		if ((renderer.isVisible && Input.GetMouseButton (0)) && !clicada)
		{
			Vector3 campos = Camera.main.WorldToScreenPoint(transform.position);
			campos.y = Operator.InvertMouseY(campos.y);
			selecionada = Operator.selection.Contains(campos);
		}

		if (selecionada)
						renderer.material.color = Color.red;
		else 
			renderer.material.color = Color.white;

	}

	private void OnMouseDown()
	{
		selecionada = true;
		clicada = true;
	}

	private void OnMouseUp()
	{
		if (clicada)
						selecionada = true;
		clicada = false;
	}

	
}
